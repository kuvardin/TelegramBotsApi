<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;
use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\ChatAdministratorRights;

/**
 * In response to this request, ChatAdministratorRights object will be received.
 *
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestChatAdministratorRights extends Request
{
    /**
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    public function sendRequest(int $attempts = 1): ChatAdministratorRights
    {
        return ChatAdministratorRights::makeByArray($this->request($attempts));
    }
}