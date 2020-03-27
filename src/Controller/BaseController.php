<?php

namespace App\Controller;
use App\Exception\UnAuthException;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class BaseController extends AbstractFOSRestController
{

    /**
     * @return object|\Symfony\Component\Security\Core\User\UserInterface|null
     * @throws UnAuthException
     */
    public function auth()
    {
        $user = $this->getUser();

        if (!$user) {
            throw new UnAuthException();
        }

        return $user;
    }
}