<?php

declare(strict_types=1);

namespace App\Mapper\PersonalInformationMapper;

use App\Data\PersonalInformation;
use App\Entity\User;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class EmailPersonalInformationMapper implements PersonalInformationMapperInterface
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    public function map(User $user): PersonalInformation
    {
        return new PersonalInformation($this->translator->trans('account.personal_information.email'), $user->getEmail());
    }
}
