<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\OwnedGifts;

/**
 * In response to this request, OwnedGifts object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestOwnedGifts extends Request
{
    public function sendRequest(int $attempts = 1): OwnedGifts
    {
        return OwnedGifts::makeByArray($this->request($attempts));
    }
}