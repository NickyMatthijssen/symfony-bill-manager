<?php

declare(strict_types=1);

namespace App\Presentation\Form\Type\Bill;

use App\Domain\Enum\Interval;
use App\Presentation\Form\Model\Bill\UpdateBill;
use App\Presentation\Form\Type\Input\MoneyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @extends AbstractType<UpdateBill>
 */
final class UpdateBillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class, [
            'label' => 'dashboard.bill.form.name',
        ])
            ->add('interval', EnumType::class, [
                'class' => Interval::class,
                'label' => 'dashboard.bill.form.interval',
            ])
            ->add('amount', MoneyType::class, [
                'label' => 'dashboard.bill.form.amount',
            ])
            ->add('url', UrlType::class, [
                'required' => false,
                'label' => 'dashboard.bill.form.url',
                'attr' => [
                    'placeholder' => 'dashboard.bill.form.url_placeholder',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'dashboard.bill.form.submit',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UpdateBill::class,
        ]);
    }
}
