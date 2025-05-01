<?php

declare(strict_types=1);

namespace App\Presentation\Form\Type\Account;

use App\Presentation\Form\Model\Account\UpdateAccount;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @extends AbstractType<UpdateAccount>
 */
final class UpdateAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'account.personal_information.email',
            ])
            ->add('firstName', TextType::class, [
                'label' => 'account.personal_information.first_name',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'account.personal_information.last_name',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'account.personal_information.edit.update',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UpdateAccount::class,
        ]);
    }
}
