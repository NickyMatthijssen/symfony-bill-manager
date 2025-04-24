<?php

declare(strict_types=1);

namespace App\Form\Type\Input;

use App\Form\Transformer\MoneyTransformer;
use Symfony\Component\Form\Extension\Core\Type\MoneyType as SymfonyMoneyType;
use Symfony\Component\Form\FormBuilderInterface;

final class MoneyType extends SymfonyMoneyType
{
    public function __construct(private readonly MoneyTransformer $transformer)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer($this->transformer);

        parent::buildForm($builder, $options);
    }
}
