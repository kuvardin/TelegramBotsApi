<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;

/**
 * Class ExportChatInviteLink
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ExportChatInviteLink extends TelegramBotsApi\Request
{
    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'exportChatInviteLink';
    }

    /**
     * @param int $attempts
     * @return string
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public function sendRequest(int $attempts = 1): string
    {
        return $this->request($attempts);
    }
}
