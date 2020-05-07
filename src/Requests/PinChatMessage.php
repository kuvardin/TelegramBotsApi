<?php

declare(strict_types=1);

namespace TelegramBotsApi\Requests;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * Class PinChatMessage
 *
 * @package TelegramBotsApi
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
     * @throws Error
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
