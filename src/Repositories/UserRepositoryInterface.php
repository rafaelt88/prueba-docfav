<?php
namespace App\Repositories;

use App\Attributes\Email;
use App\Attributes\UserId;
use App\Entities\User;

interface UserRepositoryInterface
{

    public function save(User $user): void;

    public function findById(string|UserId $id): ?User;

    public function findByEmail(string|Email $email): ?User;

    public function delete(string|UserId $id): void;
}