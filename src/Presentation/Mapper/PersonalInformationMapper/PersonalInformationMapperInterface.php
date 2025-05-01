<?php

declare(strict_types=1);

namespace App\Presentation\Mapper\PersonalInformationMapper;

use App\Domain\Entity\User;
use App\Presentation\Data\PersonalInformation;

interface PersonalInformationMapperInterface
{
    public function map(User $user): PersonalInformation;
}
