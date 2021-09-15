<?php

declare(strict_types=1);

namespace App\Pendu;

use App\Entity\Game;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Stopwatch\Stopwatch;

final class GameMechanics
{
    private SessionInterface $session;
    private ?Game $game = null;
    private Stopwatch $stopwatch;

    public function __construct(SessionInterface $session, Stopwatch $stopwatch)
    {
        $this->session = $session;
        $this->stopwatch = $stopwatch;
        $this->init();
    }

    public function init(): Game
    {
        if (null === $this->game = $this->session->get('game')) {
            $this->game = new Game('test');
            $this->session->set('game', $this->game);
        }

        return $this->game;
    }

    public function getGame(): Game
    {
        return $this->game;
    }

    public function tryLetter(string $letter) {
        $this->game->addLetter($letter);

        if (false === strpos($this->getHiddenWord(), '_')) {
            $this->game->setStatus(Game::STATUSES_WON);
        }

        $this->session->set('game', $this->game);
    }

    public function getHiddenWord(): string
    {
        $hiddenWord = [];

        foreach (str_split(strtoupper($this->game->getWord())) as $word) {
            $found = false;
            foreach ($this->game->getLetters() as $letter) {
                if($letter === $word){
                    $hiddenWord[] = $letter;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $hiddenWord[] = '_';
            }
        }

        return implode(' ', $hiddenWord);
    }

    public function getGameStatus(): string
    {
        return $this->game->getStatus();
    }
}
