<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\PreparedKeyboardButton;

/**
 * In response to this request, PreparedKeyboardButton object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestPreparedKeyboardButton extends Request
{
    public function sendRequest(int $attempts = 1): PreparedKeyboardButton
    {
        return PreparedKeyboardButton::makeByArray($this->request($attempts));
    }
}