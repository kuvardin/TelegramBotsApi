<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\UserProfileAudios;

/**
 * In response to this request, UserProfileAudios object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestUserProfileAudios extends Request
{
    public function sendRequest(int $attempts = 1): UserProfileAudios
    {
        return UserProfileAudios::makeByArray($this->request($attempts));
    }
}