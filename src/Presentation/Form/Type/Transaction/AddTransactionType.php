<?php

declare(strict_types=1);

namespace App\Presentation\Form\Type\Transaction;

use App\Domain\Enum\Interval;
use App\Domain\Enum\TransactionType;
use App\Presentation\Form\Model\Transaction\AddTransaction;
use App\Presentation\Form\Type\Input\MoneyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @extends AbstractType<AddTransaction>
 */
final class AddTransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'dashboard.transaction.form.name',
                'constraints' => [new Assert\Length(max: 255)],
            ])
            ->add('type', EnumType::class, [
                'class' => TransactionType::class,
                'label' => 'dashboard.transaction.form.type',
                'constraints' => [new Assert\NotBlank()],
            ])
            ->add('interval', EnumType::class, [
                'class' => Interval::class,
                'label' => 'dashboard.transaction.form.interval',
                'constraints' => [new Assert\NotBlank()],
            ])
            ->add('amount', MoneyType::class, [
                'label' => 'dashboard.transaction.form.amount',
                'constraints' => [new Assert\NotBlank()],
            ])
            ->add('url', UrlType::class, [
                'required' => false,
                'label' => 'dashboard.transaction.form.url',
                'attr' => [
                    'placeholder' => 'dashboard.transaction.form.url_placeholder',
                ],
                'constraints' => [
                    new Assert\AtLeastOneOf([
                        new Assert\Url(),
                        new Assert\Blank(),
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'dashboard.transaction.form.submit',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AddTransaction::class,
        ]);
    }
}
