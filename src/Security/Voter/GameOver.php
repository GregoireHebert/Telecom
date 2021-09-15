<?php

declare(strict_types=1);

namespace App\Security\Voter;

use App\Entity\Game;
use App\Pendu\GameMechanics;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class GameOver extends Voter
{
    protected function supports(string $attribute, $subject)
    {
        return $attribute === 'GAME_IS_ON' && $subject instanceof GameMechanics;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        /** @var GameMechanics $subject */
        return $subject->getGameStatus() === Game::STATUSES_ONGOING;
    }
}
