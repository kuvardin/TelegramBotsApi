<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\BotAccessSettings;

/**
 * In response to this request, BotAccessSettings object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestBotAccessSettings extends Request
{
    public function sendRequest(int $attempts = 1): BotAccessSettings
    {
        return BotAccessSettings::makeByArray($this->request($attempts));
    }
}