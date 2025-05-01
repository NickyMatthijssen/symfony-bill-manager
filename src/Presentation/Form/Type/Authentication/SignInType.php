<?php

declare(strict_types=1);

namespace App\Presentation\Form\Type\Authentication;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @extends AbstractType<array{email: ?string, password: ?string}>
 */
final class SignInType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('email', EmailType::class, [
            'label' => 'authentication.sign_in.email',
        ])
            ->add('password', PasswordType::class, [
                'label' => 'authentication.sign_in.password',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'authentication.sign_in.submit',
                'attr' => [
                    'class' => 'button-full',
                ],
            ]);
    }
}
