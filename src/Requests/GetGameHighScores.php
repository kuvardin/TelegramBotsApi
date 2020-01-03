<?php declare(strict_types=1);

namespace TelegramBotsApi\Requests;

use TelegramBotsApi;

/**
 * Class GetGameHighScores
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GetGameHighScores extends TelegramBotsApi\Request
{
    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'getGameHighScores';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\GameHighScore[]
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public function sendRequest(int $attempts = 1): array
    {
        $result = [];
        $response = $this->request($attempts);
        foreach ($response as $game_high_score_data) {
            $result[] = new TelegramBotsApi\Types\GameHighScore($game_high_score_data);
        }
        return $result;
    }
}