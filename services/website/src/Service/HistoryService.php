<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class HistoryService
{
    private const SESS_HISTORY_NAME = 'history';
    private const MAX_COUNT = 10;

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function getAll(): array
    {
        return $this->session->get(self::SESS_HISTORY_NAME, []);
    }

    public function add(array $item): void
    {
        $history = $this->getAll();

        $count = array_unshift($history, $item);

        if ($count > self::MAX_COUNT) {
            array_pop($history);
        }

        $this->session->set(self::SESS_HISTORY_NAME, $history);
    }
}
