<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;
use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\User;

/**
 * In response to this request, User object will be received.
 *
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestUser extends Request
{
    /**
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    public function sendRequest(int $attempts = 1): User
    {
        return User::makeByArray($this->request($attempts));
    }
}