<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;

/**
 * Class SendGame
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SendGame extends TelegramBotsApi\Request
{
    use Traits\InlineKeyboardMarkupEdit;
    use Traits\NotificationDisablingEdit;
    use Traits\ReplyToMessageEdit;

    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'sendGame';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\Message
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws TelegramBotsApi\Exceptions\Error
     * @throws \JsonException
     * @throws \JsonException
     */
    public function sendRequest(int $attempts = 1): TelegramBotsApi\Types\Message
    {
        return new TelegramBotsApi\Types\Message($this->request($attempts));
    }
}
