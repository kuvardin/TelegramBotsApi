<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;

/**
 * Class SendMessage
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SendMessage extends TelegramBotsApi\Request
{
    use Traits\ForceReplyEdit;
    use Traits\InlineKeyboardMarkupEdit;
    use Traits\NotificationDisablingEdit;
    use Traits\ParseModeEdit;
    use Traits\ReplyKeyboardMarkupEdit;
    use Traits\ReplyKeyboardRemovingEdit;
    use Traits\ReplyToMessageEdit;
    use Traits\WebPagePreviewSendingEdit;

    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'sendMessage';
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
