<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;
use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\MessageId;

/**
 * In response to this request, array of MessageId object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestMessageIds extends Request
{
    /**
     * @return MessageId[]
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    public function sendRequest(int $attempts = 1): array
    {
        $response = $this->request($attempts);

        $result = [];
        foreach ($response as $message_id_data) {
            $result[] = MessageId::makeByArray($message_id_data);
        }

        return $result;
    }
}