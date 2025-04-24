<?php

declare(strict_types=1);

namespace App\Mapper\PersonalInformationMapper;

use App\Data\PersonalInformation;
use App\Entity\User;

interface PersonalInformationMapperInterface
{
    public function map(User $user): PersonalInformation;
}
