<?php


namespace App\Security\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * ApiUserProvider constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function loadUserByUsername(string $username)
    {
        $user = $this->findUser($username);

        if (!$user) {
            throw new UsernameNotFoundException(sprintf('Not found user the username %s', $username));
        }

        return $user;
    }

    /**
     * @param $user
     *
     * @return User|null
     */
    private function findUser($user): ?UserInterface
    {
        $username = $user instanceof UserInterface ? $user->getEmail() : $user;

        return $this->repository->findOneBy(['email' => $username]);
    }

    /**
     * @inheritDoc
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf(
                'Instances of "%s" are not supported.',
                $class
            ));
        }

        /** @var User $refreshedUser */
        if (!$refreshedUser = $this->findUser($user)) {
            throw new UsernameNotFoundException(sprintf('Not found user the username %s', $user->getUsername()));
        }

        return $refreshedUser;
    }

    /**
     * @inheritDoc
     */
    public function supportsClass(string $class)
    {
        return User::class === $class;
    }
}
