<?php

declare(strict_types=1);

namespace App\Presentation\Provider;

use App\Domain\Entity\User;
use App\Presentation\Data\PersonalInformation;

interface PersonalInformationProviderInterface
{
    /**
     * @return list<PersonalInformation>
     */
    public function getPersonalInformation(User $user): array;
}
