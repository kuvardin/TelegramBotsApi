<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\UserChatBoosts;

/**
 * In response to this request, UserChatBoosts object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestUserChatBoosts extends Request
{
    public function sendRequest(int $attempts = 1): UserChatBoosts
    {
        return UserChatBoosts::makeByArray($this->request($attempts));
    }
}