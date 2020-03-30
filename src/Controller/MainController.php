<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Swagger\Annotations as SWG;

class MainController extends BaseController
{
	/**
	 * @Route("/api/hello", name="hello", methods="GET")
     * @SWG\Tag(name="Test Controller")
     * @SWG\Response(
     *     response=200,
     *     description="test",
     * )
     * @SWG\Parameter(
     *     name="order",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * )
     * @return Response
     */
    public function indexAction(): Response
    {
        return new JsonResponse([
            'hello' => 'This is a simple example of resource returned by your APIs'
        ]);
    }

	/**
	 * @Route("/api/test", name="test", methods="GET")
     * @SWG\Tag(name="Test Controller")
     * @SWG\Response(
     *     response=200,
     *     description="test",
     * )
     * @SWG\Parameter(
     *     name="order",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * )
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
