<?php

declare(strict_types=1);

namespace TelegramBotsApi\Requests;

use TelegramBotsApi;

/**
 * Class GetMe
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GetMe extends TelegramBotsApi\Request
{
    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'getMe';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\User
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public function sendRequest(int $attempts = 1): TelegramBotsApi\Types\User
    {
        return new TelegramBotsApi\Types\User($this->request($attempts));
    }
}
