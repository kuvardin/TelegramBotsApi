<?php

declare(strict_types=1);

namespace TelegramBotsApi\Requests;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * Class EditMessageReplyMarkup
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class EditMessageReplyMarkup extends TelegramBotsApi\Request
{
    use Traits\InlineKeyboardMarkupEdit;

    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'editMessageReplyMarkup';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\Message|null
     * @throws Error
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
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
