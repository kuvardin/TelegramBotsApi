<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;

/**
 * Class GetUserProfilePhotos
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GetUserProfilePhotos extends TelegramBotsApi\Request
{
    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'getUserProfilePhotos';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\UserProfilePhotos
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public function sendRequest(int $attempts = 1): TelegramBotsApi\Types\UserProfilePhotos
    {
        return new TelegramBotsApi\Types\UserProfilePhotos($this->request($attempts));
    }
}
