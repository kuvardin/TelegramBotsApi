<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;
use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\MessageId;

/**
 * In response to this request, MessageId object will be received.
 *
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestMessageId extends Request
{
    /**
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    public function sendRequest(int $attempts = 1): MessageId
    {
        return MessageId::makeByArray($this->request($attempts));
    }
}