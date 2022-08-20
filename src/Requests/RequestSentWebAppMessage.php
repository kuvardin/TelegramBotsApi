<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;
use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\SentWebAppMessage;

/**
 * In response to this request, SentWebAppMessage object will be received.
 *
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestSentWebAppMessage extends Request
{
    /**
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    public function sendRequest(int $attempts = 1): SentWebAppMessage
    {
        return SentWebAppMessage::makeByArray($this->request($attempts));
    }
}