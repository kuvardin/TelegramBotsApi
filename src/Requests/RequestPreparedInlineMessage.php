<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\PreparedInlineMessage;

/**
 * In response to this request, PreparedInlineMessage object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestPreparedInlineMessage extends Request
{
    public function sendRequest(int $attempts = 1): PreparedInlineMessage
    {
        return PreparedInlineMessage::makeByArray($this->request($attempts));
    }
}