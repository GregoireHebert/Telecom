<?php

declare(strict_types=1);

namespace App\Controller\Pendu;

use App\Pendu\GameMechanics;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route(name="pendu_try_letter", path="/pendu/{letter<[A-Z]{1}>}")
 */
class TryLetter extends AbstractController
{
    public function __invoke(string $letter, GameMechanics $gameMechanics, ValidatorInterface $validator)
    {
        $gameMechanics->tryLetter($letter);
        $gameMechanics->getGame()->setStatus('bidule');

        $violations = $validator->validate($gameMechanics->getGame());
        if ($violations->count()){
            dump($violations);
        }

        return $this->forward(Pendu::class.'::getGame');
    }
}
