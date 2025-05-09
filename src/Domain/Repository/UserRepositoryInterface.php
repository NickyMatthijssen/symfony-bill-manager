<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function findById(int $id): User;

    public function findByUserIdentifier(string $userIdentifier): User;
}
