<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;

/**
 * Class StopPoll
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class StopPoll extends TelegramBotsApi\Request
{
    use Traits\InlineKeyboardMarkupEdit;

    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'stopPoll';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\Poll
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public function sendRequest(int $attempts = 1): TelegramBotsApi\Types\Poll
    {
        return new TelegramBotsApi\Types\Poll($this->request($attempts));
    }
}
