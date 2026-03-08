<?php

namespace App\Repository;

use App\Entity\Project;
use App\Enum\ProjectStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Project>
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    /**
     * @return Paginator<Project>
     */
    public function findByFilters(
        ?ProjectStatus $status = null,
        ?string $search = null,
        ?\DateTimeInterface $dateFrom = null,
        ?\DateTimeInterface $dateTo = null,
        string $sortBy = 'createdAt',
        string $sortDir = 'DESC',
        int $page = 1,
        int $limit = 12,
    ): Paginator {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.customer', 'c')
            ->leftJoin('p.event', 'e')
            ->addSelect('c', 'e');

        if ($status !== null) {
            $qb->andWhere('p.status = :status')->setParameter('status', $status);
        }

        if ($search !== null && $search !== '') {
            $qb->andWhere('c.name LIKE :search OR c.company LIKE :search OR c.email LIKE :search OR p.title LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        if ($dateFrom !== null) {
            $qb->andWhere('e.eventDate >= :dateFrom')->setParameter('dateFrom', $dateFrom);
        }

        if ($dateTo !== null) {
            $qb->andWhere('e.eventDate <= :dateTo')->setParameter('dateTo', $dateTo);
        }

        $allowedSortFields = ['createdAt', 'updatedAt'];
        if (!in_array($sortBy, $allowedSortFields, true)) {
            $sortBy = 'createdAt';
        }
        $sortDir = strtoupper($sortDir) === 'ASC' ? 'ASC' : 'DESC';

        $qb->orderBy('p.' . $sortBy, $sortDir)
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        return new Paginator($qb);
    }
}
