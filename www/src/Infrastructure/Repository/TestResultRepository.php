<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entities\Test\TestResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TestResultRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, TestResult::class);
        $this->entityManager = $entityManager;
    }

    public function save(TestResult $result): void
    {
        $this->getEntityManager()->persist($result);
        $this->getEntityManager()->flush();
    }

    public function getResultTest(int $resultTestId): TestResult
    {
        $resultTest = $this->findOneBy(['id' => $resultTestId]);
        if (!$resultTest) {
            throw new NotFoundHttpException();
        }

        return $resultTest;
    }

}