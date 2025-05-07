<?php

declare(strict_types=1);

namespace App\Presentation\Form\Type\Transaction;

use App\Presentation\Form\Model\Transaction\DeleteTransaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @extends AbstractType<DeleteTransaction>
 */
final class DeleteTransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('confirmed', CheckboxType::class, [
                'label' => 'dashboard.transaction.delete.confirmation',
                'constraints' => [new NotBlank()],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'dashboard.transaction.delete.submit',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DeleteTransaction::class,
        ]);
    }
}
