<?php
namespace App\Core;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineRepository extends EntityRepository
{

    protected function getEntityManager(): EntityManagerInterface
    {
        return $GLOBALS['app']->getEntityManager();
    }
}