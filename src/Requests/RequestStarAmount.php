<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\StarAmount;

/**
 * In response to this request, StarAmount object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestStarAmount extends Request
{
    public function sendRequest(int $attempts = 1): StarAmount
    {
        return StarAmount::makeByArray($this->request($attempts));
    }
}