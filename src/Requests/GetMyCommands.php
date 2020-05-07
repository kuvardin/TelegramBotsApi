<?php

declare(strict_types=1);

namespace TelegramBotsApi\Requests;

use TelegramBotsApi;

/**
 * Class GetMyCommands
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GetMyCommands extends TelegramBotsApi\Request
{
    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'getMyCommands';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\BotCommand[]
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public function sendRequest(int $attempts = 1): array
    {
        $result = [];
        $response = $this->request($attempts);
        foreach ($response as $bot_command_data) {
            $result[] = new TelegramBotsApi\Types\BotCommand($bot_command_data);
        }
        return $result;
    }
}
