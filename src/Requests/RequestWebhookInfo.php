<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;
use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\WebhookInfo;

/**
 * In response to this request, WebhookInfo object will be received.
 *
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestWebhookInfo extends Request
{
    /**
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    public function sendRequest(int $attempts = 1): WebhookInfo
    {
        return WebhookInfo::makeByArray($this->request($attempts));
    }
}