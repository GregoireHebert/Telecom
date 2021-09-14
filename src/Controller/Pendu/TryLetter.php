<?php

declare(strict_types=1);

namespace App\Controller\Pendu;

use App\Pendu\GameMechanics;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="pendu_try_letter", path="/pendu/{letter}")
 */
class TryLetter extends AbstractController
{
    public function __invoke(string $letter, GameMechanics $gameMechanics)
    {
        $gameMechanics->tryLetter($letter);

        return $this->forward(Pendu::class.'::getGame');
    }
}
