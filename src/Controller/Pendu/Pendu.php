<?php

declare(strict_types=1);

namespace App\Controller\Pendu;

use App\Entity\Game;
use App\Pendu\GameMechanics;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Pendu extends AbstractController
{
    /**
     * @Route(name="pendu", path="/pendu")
     */
    public function getGame(GameMechanics $gameMechanics): Response
    {
        return $this->render('pendu.html.twig', ['gameMechanics' => $gameMechanics]);
    }
}
