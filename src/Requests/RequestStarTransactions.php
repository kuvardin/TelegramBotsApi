<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\StarTransactions;

/**
 * In response to this request, StarTransactions object will be received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestStarTransactions extends Request
{
    public function sendRequest(int $attempts = 1): StarTransactions
    {
        return StarTransactions::makeByArray($this->request($attempts));
    }
}