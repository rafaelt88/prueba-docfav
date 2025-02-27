<?php
namespace App\Repositories;

use App\Core\DoctrineRepository;
use App\Entities\User;
use App\Attributes\UserId;
use App\Attributes\Email;

class DoctrineUserRepository extends DoctrineRepository implements UserRepositoryInterface
{

    public function save(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function findById(string|UserId $id): ?User
    {
        return $this->getEntityManager()->find(User::class, strval($id));
    }

    public function findByEmail(string|Email $email): ?User
    {
        $model = $this->getEntityManager()
            ->getRepository(User::class)
            ->findOneBy(
                [
                'email' => strval($email)
                ]
            );

        if ($model) {
            $model->getId();
        }

        return $model;
    }

    public function delete(string|UserId $id): void
    {
        $user = $this->findById($id);
        if ($user) {
            $this->getEntityManager()->remove($user);
            $this->getEntityManager()->flush();
        }
    }
}