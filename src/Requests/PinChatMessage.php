<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;
use Kuvardin\TelegramBotsApi\Exceptions\Error;

/**
 * Class PinChatMessage
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PinChatMessage extends TelegramBotsApi\Request
{
    use Traits\NotificationDisablingEdit;

    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'pinChatMessage';
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
