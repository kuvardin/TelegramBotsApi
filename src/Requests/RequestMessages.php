<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;
use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\Message;

/**
 * In response to this request, array of Message object will be received.
 *
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestMessages extends Request
{
    /**
     * @return Message[]
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    public function sendRequest(int $attempts = 1): array
    {
        $response = $this->request($attempts);

        $result = [];
        foreach ($response as $message_data) {
            $result[] = Message::makeByArray($message_data);
        }

        return $result;
    }
}