<?php

declare(strict_types=1);

namespace App\Form\Type\Bill;

use App\Form\Model\Bill\DeleteBill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @extends AbstractType<DeleteBill>
 */
final class DeleteBillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('confirmation', CheckboxType::class, [
                'label' => 'dashboard.bill.delete.confirmation',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'dashboard.bill.delete.submit',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DeleteBill::class,
        ]);
    }
}
