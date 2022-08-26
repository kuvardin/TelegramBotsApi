<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;
use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\GameHighScore;

/**
 * In response to this request, array of GameHighScore object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestGameHighScores extends Request
{
    /**
     * @return GameHighScore[]
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    public function sendRequest(int $attempts = 1): array
    {
        $response = $this->request($attempts);

        $result = [];
        foreach ($response as $game_high_score_data) {
            $result[] = GameHighScore::makeByArray($game_high_score_data);
        }

        return $result;
    }
}