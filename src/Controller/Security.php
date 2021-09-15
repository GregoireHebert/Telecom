<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route(name="login", path="/login")
 */
class Security extends AbstractController
{
    public function __invoke(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('login.html.twig', [
           'username' => $authenticationUtils->getLastUsername(),
           'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }
}
