<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository\User;

use App\Domain\Entity\User\User;
use App\Domain\Entity\User\ValueObject\Status;
use App\Domain\Entity\ValueObject\Email;
use App\Domain\Entity\ValueObject\Id;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Service\User\Criteria\UserSearchCriteria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\Uuid;
use RuntimeException;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function getNextIdentity(): Id
    {
        $uuid = Uuid::uuid4();

        return new Id($uuid->toString());
    }

    /**
     * @inheritDoc
     */
    public function isExistsByEmail(Email $email): bool
    {
        return $this->findBy([
            'email.email' => (string)$email,
        ]) !== [];
    }

    /**
     * @param Id $id
     * @return User
     */
    public function get(Id $id): User
    {
        /** @var User $user */
        $user = $this->find($id);

        if ($user === null) {
            throw new \DomainException(sprintf('User with id "%s" not found', $id));
        }

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function save(User $user): void
    {
        try {
            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();
        } catch (OptimisticLockException|ORMException $e) {
            throw new RuntimeException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @return User[]
     */
    public function getAll(): array
    {
        return $this->findAll();
    }

    /**
     * @param UserSearchCriteria $userSearchCriteria
     * @return User[]
     */
    public function findByCriteria(UserSearchCriteria $userSearchCriteria): array
    {
        $query = $this->createQueryBuilder('user');

        if ($userSearchCriteria->name !== null) {
            $query
                ->andWhere('LOWER(user.name.firstName) LIKE :name OR LOWER(user.name.lastName) LIKE :name')
                ->setParameter('name', '%' . strtolower($userSearchCriteria->name) . '%');
        }

        $query->andWhere('user.status.status = :status')->setParameter('status', Status::ACTIVE);

        return $query->getQuery()->getResult();
    }
}
