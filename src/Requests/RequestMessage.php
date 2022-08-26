<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\Message;

/**
 * In response to this request, Message object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestMessage extends Request
{
    public function sendRequest(int $attempts = 1): Message
    {
        return Message::makeByArray($this->request($attempts));
    }
}