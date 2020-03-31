<?php

namespace App\Controller;

use App\Resources\FractalCollection;
use App\Resources\UserCollection;
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
     * @Route("/api/own", name="own", methods="GET")
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
        $auth = $this->auth();
        $user = new UserCollection($auth);
        return new JsonResponse($user->toArray());
    }

    /**
     * @Route("/api/resource", name="test", methods="GET")
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
    public function resourceAction(): Response
    {
        $books = [
            [
                'id' => '1',
                'title' => 'Hog father',
                'yr' => '1998',
                'author_name' => 'Philip K Dick',
                'author_email' => 'philip@example.org',
            ],
            [
                'id' => '2',
                'title' => 'Game Of Kill Everyone',
                'yr' => '2014',
                'author_name' => 'George R. R. Satan',
                'author_email' => 'george@example.org',
            ]
        ];
        $resource = new FractalCollection($books);

        return new JsonResponse($resource->toArray());
    }


}
