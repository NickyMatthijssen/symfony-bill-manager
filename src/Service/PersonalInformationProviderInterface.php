<?php

declare(strict_types=1);

namespace App\Service;

use App\Data\PersonalInformation;
use App\Entity\User;

interface PersonalInformationProviderInterface
{
    /**
     * @return list<PersonalInformation>
     */
    public function getPersonalInformation(User $user): array;
}
