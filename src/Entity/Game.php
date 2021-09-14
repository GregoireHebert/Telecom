<?php

declare(strict_types=1);

namespace App\Entity;

final class Game
{
    public const MAX_TRIALS = 11;
    public const STATUSES_ONGOING = 'en cours';
    public const STATUSES_WON = 'Gagné';
    public const STATUSES_LOST = 'Perdu';

    private ?string $word = null;
    private array $triedLetters = [];
    private string $status = self::STATUSES_ONGOING;

    public function __construct(string $word)
    {
        $this->word = $word;
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $statuses = [self::STATUSES_LOST, self::STATUSES_ONGOING, self::STATUSES_WON];

        if (!in_array($status, $statuses)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid status, expected one of: %s', implode(', ', $statuses))
            );
        }

        // TODO use workflow to prevent mis-usage.

        $this->status = $status;
    }

    public function addLetter(string $letter): void
    {
        if (strlen($letter) !== 1 || preg_match('/^[0-9]$/', $letter)) {
            throw new \InvalidArgumentException('letter should be a 1 char long string');
        }

        $normalizedLetter = strtoupper($letter);
        $this->triedLetters[$normalizedLetter] = $normalizedLetter;
    }

    public function getLetters(): array
    {
        return $this->triedLetters;
    }
}
