<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entities\Test\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Question::class);
        $this->entityManager = $entityManager;
    }

    public function findQuestions(int $testId): ArrayCollection
    {
        $questions = $this->createQueryBuilder('q')
            ->where('q.test = :testId')
            ->setParameter('testId', $testId)
            ->getQuery()
            ->getResult();

        return new ArrayCollection($questions);
    }

    public function getQuestions(int $testId): ArrayCollection
    {
        $questions = $this->findQuestions($testId);
        if ($questions->isEmpty()) {
            throw new NotFoundHttpException();
        }

        return $questions;
    }
}
