<?php

declare(strict_types=1);

namespace App\Form\Type\Account;

use App\Form\Model\Account\UpdatePassword;
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

final class UpdatePasswordType extends AbstractType
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'label' => 'account.security_settings.password.form.current_password',
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'account.security_settings.password.form.new_password',
                ],
                'second_options' => [
                    'label' => 'account.security_settings.password.form.confirm_password',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'account.security_settings.password.form.submit',
            ]);

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            assert($data instanceof UpdatePassword);

            if (!$this->userPasswordHasher->isPasswordValid($data->user, $data->currentPassword)) {
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
