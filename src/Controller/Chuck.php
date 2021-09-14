<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Twig\Environment;

/**
 * @Route(name="chuck", path="/chuck")
 */
class Chuck extends AbstractController
{
    public function __invoke(HttpClientInterface $chuckClient, LoggerInterface $logger, Environment $twig): Response
    {
        $response = $chuckClient->request('GET', '/jokes/random');
        $data = dump(json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR));

        $logger->critical('très grave!', ['data'=>$data]);
//        throw new NotFoundHttpException('pas trouvé');
        $this->addFlash('error', 'Récupération ok');

        return new Response($twig->render('chuck.html.twig', ['blague' => $data['value']]));
        return $this->render('chuck.html.twig', ['blague' => $data['value']]);
    }
}
