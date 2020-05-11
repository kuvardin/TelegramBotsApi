<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;
use Kuvardin\TelegramBotsApi\Exceptions\Error;

/**
 * Class EditMessageLiveLocation
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class EditMessageLiveLocation extends TelegramBotsApi\Request
{
    use Traits\InlineKeyboardMarkupEdit;

    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'editMessageLiveLocation';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\Message|null
     * @throws Error
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws \JsonException
     * @throws \JsonException
     */
    public function sendRequest(int $attempts = 1): ?TelegramBotsApi\Types\Message
    {
        $response = $this->request($attempts);
        if (is_bool($response)) {
            if ($response !== true) {
                $type = gettype($response);
                throw new Error("Incorrect response: $response typed $type (must be true)");
            }
            return null;
        }

        return new TelegramBotsApi\Types\Message($response);
    }
}
