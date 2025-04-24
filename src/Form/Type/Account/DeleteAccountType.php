<?php

declare(strict_types=1);

namespace App\Form\Type\Account;

use App\Form\Model\Account\DeleteAccount;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Required;

/**
 * @extends AbstractType<DeleteAccount>
 */
final class DeleteAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('agreesToBeDeleted', CheckboxType::class, [
                'label' => 'account.delete.form.agrees_to_be_deleted',
                'constraints' => [new Required()],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'account.delete.form.submit',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DeleteAccount::class,
        ]);
    }
}
