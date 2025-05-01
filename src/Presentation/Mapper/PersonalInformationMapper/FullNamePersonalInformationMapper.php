<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\PersonalInformationMapper;

use App\Domain\Entity\User;
use App\Presentation\Data\PersonalInformation;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class FullNamePersonalInformationMapper implements PersonalInformationMapperInterface
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    public function map(User $user): PersonalInformation
    {
        return new PersonalInformation($this->translator->trans('account.personal_information.full_name'), $user->getFullName());
    }
}
