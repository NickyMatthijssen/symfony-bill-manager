<?php

declare(strict_types=1);

namespace App\Presentation\Form\Type\Security;

use App\Domain\Entity\User;
use App\Presentation\Form\Model\Account\UpdatePassword;
use RuntimeException;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @extends AbstractType<UpdatePassword>
 */
final class UpdatePasswordType extends AbstractType
{
    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHasher,
        private readonly Security $security,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'label' => 'account.security_settings.password.form.current_password',
                'constraints' => [new Assert\NotBlank()],
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'account.security_settings.password.form.new_password',
                ],
                'second_options' => [
                    'label' => 'account.security_settings.password.form.confirm_password',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(min: 8, max: 32),
                    new Assert\NotCompromisedPassword(),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'account.security_settings.password.form.submit',
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event): void {
                $data = $event->getData();
                assert($data instanceof UpdatePassword);

                $user = $this->security->getUser();
                if (!($user instanceof User)) {
                    throw new RuntimeException('There should be a signed in user to use the update password form.');
                }

                if (!$this->userPasswordHasher->isPasswordValid($user, (string) $data->getCurrentPassword())) {
                    $event->getForm()->get('currentPassword')->addError(new FormError('Invalid current password'));
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UpdatePassword::class,
        ]);
    }
}
