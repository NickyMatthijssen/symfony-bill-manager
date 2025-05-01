<?php

declare(strict_types=1);

namespace App\Presentation\Form\Type\Bill;

use App\Presentation\Form\Model\Bill\DeleteBill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @extends AbstractType<DeleteBill>
 */
final class DeleteBillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('confirmed', CheckboxType::class, [
                'label' => 'dashboard.bill.delete.confirmation',
                'constraints' => [new NotBlank()]
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
