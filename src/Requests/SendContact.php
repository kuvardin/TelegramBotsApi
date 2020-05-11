<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;

/**
 * Class SendContact
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SendContact extends TelegramBotsApi\Request
{
    use Traits\ForceReplyEdit;
    use Traits\InlineKeyboardMarkupEdit;
    use Traits\NotificationDisablingEdit;
    use Traits\ReplyKeyboardMarkupEdit;
    use Traits\ReplyKeyboardRemovingEdit;
    use Traits\ReplyToMessageEdit;

    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'sendContact';
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
