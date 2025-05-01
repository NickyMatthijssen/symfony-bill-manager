<?php

declare(strict_types=1);

namespace App\Presentation\Form\Type\Authentication;

use App\Presentation\Form\Model\Authentication\SignUp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @extends AbstractType<SignUp>
 */
final class SignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('email', EmailType::class, [
            'label' => 'authentication.sign_up.email',
        ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'authentication.sign_up.password',
                ],
                'second_options' => [
                    'label' => 'authentication.sign_up.password_confirmation',
                ],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'authentication.sign_up.first_name',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'authentication.sign_up.last_name',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'authentication.sign_up.submit',
                'attr' => [
                    'class' => 'button-full',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SignUp::class,
        ]);
    }
}
