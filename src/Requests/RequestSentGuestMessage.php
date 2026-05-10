<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\SentGuestMessage;

/**
 * In response to this request, SentGuestMessage object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestSentGuestMessage extends Request
{
    public function sendRequest(int $attempts = 1): SentGuestMessage
    {
        return SentGuestMessage::makeByArray($this->request($attempts));
    }
}