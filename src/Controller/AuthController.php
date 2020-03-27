<?php


namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class AuthController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        if ($this->getUser() instanceof User) {
            return $this->redirectToRoute('easyadmin');
        }

        $session = $this->get('session');
        $error = $session->getFlashBag()->get('error', []);
        if ($error) {
            $error = [
                'messageKey' => $error[0],
                'messageData' => []
            ];
        }
        $action = $this->get('router')->generate('login');
        $csrf_token_intention = 'authenticate';

        return $this->render('@EasyAdmin/page/login.html.twig', compact('error', 'action', 'csrf_token_intention'));
    }
}
