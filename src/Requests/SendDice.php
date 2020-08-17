<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;

/**
 * Class SendDice
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SendDice extends TelegramBotsApi\Request
{
    use Traits\NotificationDisablingEdit;
    use Traits\ReplyToMessageEdit;
    use Traits\InlineKeyboardMarkupEdit;
    use Traits\ReplyKeyboardMarkupEdit;
    use Traits\ReplyKeyboardRemovingEdit;
    use Traits\ForceReplyEdit;

    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'sendDice';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\Message
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     */
    public function sendRequest(int $attempts = 1): TelegramBotsApi\Types\Message
    {
        return new TelegramBotsApi\Types\Message($this->request($attempts));
    }
}
