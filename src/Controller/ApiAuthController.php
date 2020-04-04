<?php

namespace App\Controller;

use App\Exception\UnAuthException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;
use Swagger\Annotations as SWG;

class ApiAuthController extends BaseController
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * ApiAuthController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * User jwt token refresh by refresh token.
     *
     * @Route("/api/refresh_token", name="jwt_refresh_token", methods={"POST"})
     * @SWG\Response(
     *     response=Response::HTTP_OK,
     *     description="User token and reflesh token response.",
     *     @SWG\Schema(
     *         @SWG\Property(property="token", type="string"),
     *         @SWG\Property(property="user", type="object"),
     *         @SWG\Property(property="refresh_token", type="string")
     *     )
     * )
     * @SWG\Response(
     *     response=Response::HTTP_UNAUTHORIZED,
     *     description="Bad credentials.",
     *     @SWG\Schema(
     *         @SWG\Property(property="code", type="integer"),
     *         @SWG\Property(property="message", type="string")
     *     )
     * )
     * @SWG\Parameter(
     *     name="refresh_token",
     *     in="query",
     *     type="string",
     *      format="json",
     *     description="User refresh token",
     *     required=true
     * )
     * @SWG\Tag(name="Login")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function refreshAction(Request $request)
    {
        return $this->forward(
            'gesdinet.jwtrefreshtoken:refresh',
            [
                'request' => $request,
            ]
        );
    }

    /**
     * @Route("/api/login_check", name="jwt_login_token", methods={"POST"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="User was logged in successfully"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="User was not logged in successfully"
     * )
     *
     * @SWG\Parameter(
     *     name="email",
     *     in="body",
     *     type="string",
     *     description="Email",
     *     schema={
     *     }
     * )
     * @SWG\Parameter(
     *     name="password",
     *     in="body",
     *     type="string",
     *     description="Password",
     *     schema={}
     * )
     *
     * @SWG\Tag(name="Login")
     * @param Request $request
     * @throws UnAuthException
     */
    public function getLoginCheckAction(Request $request)
    {
    }

}