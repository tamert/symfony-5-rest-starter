<?php


namespace App\Security;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class AuthAdminHandler implements AuthenticationFailureHandlerInterface,
    AuthenticationSuccessHandlerInterface,
    LogoutSuccessHandlerInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @inheritDoc
     */
    public function onLogoutSuccess(Request $request)
    {
        return RedirectResponse::create($this->router->generate('login'));
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $session = $request->getSession();

        if ($session instanceof SessionInterface) {
            $session->start();

            $session->getFlashBag()->add('error', 'E-posta adresi/parola hatalı');
            $session->save();
        }

        return RedirectResponse::create($this->router->generate('login'));
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        dd($request);
        $user = $token->getUser();
        $request->getSession()->set('userId', $user->getId());

        return RedirectResponse::create($this->router->generate('easyadmin'));
    }
}
