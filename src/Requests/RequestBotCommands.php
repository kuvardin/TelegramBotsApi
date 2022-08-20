<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;
use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\BotCommand;

/**
 * In response to this request, array of BotCommand object will be received.
 *
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestBotCommands extends Request
{
    /**
     * @return BotCommand[]
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    public function sendRequest(int $attempts = 1): array
    {
        $response = $this->request($attempts);

        $result = [];
        foreach ($response as $bot_command_data) {
            $result[] = BotCommand::makeByArray($bot_command_data);
        }

        return $result;
    }
}