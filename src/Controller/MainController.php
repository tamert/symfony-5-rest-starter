<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends BaseController
{
	/**
	 * @Route("/api", name="hello", methods="GET")
     */
    public function indexAction(): Response
    {
        return new JsonResponse([
            'hello' => 'This is a simple example of resource returned by your APIs'
        ]);
    }

	/**
	 * @Route("/api/test", name="test", methods="GET")
     * @return Response
     * @throws \App\Exception\UnAuthException
     */
    public function testAction(): Response
    {
        $user = $this->auth();

        return new JsonResponse([
            'hello' => 'This is a simple example of resource returned by your APIs',
            'user' => $user->getUsername()
        ]);
    }


}
