<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;

/**
 * Class SendInvoice
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SendInvoice extends TelegramBotsApi\Request
{
    use Traits\InlineKeyboardMarkupEdit;
    use Traits\NotificationDisablingEdit;
    use Traits\ReplyToMessageEdit;

    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'sendInvoice';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\Message
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public function sendRequest(int $attempts = 1): TelegramBotsApi\Types\Message
    {
        return new TelegramBotsApi\Types\Message($this->request($attempts));
    }
}
