<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;
use Kuvardin\TelegramBotsApi\Exceptions\Error;

/**
 * Class DeleteMessage
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class DeleteMessage extends TelegramBotsApi\Request
{
    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'deleteMessage';
    }

    /**
     * @param int $attempts
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     */
    public function sendRequest(int $attempts = 1): void
    {
        $response = $this->request($attempts);
        if ($response !== true) {
            $type = gettype($response);
            throw new Error("Incorrect response: $response typed $type (must be true)");
        }
    }
}
