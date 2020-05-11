<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;

/**
 * Class GetFile
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GetFile extends TelegramBotsApi\Request
{
    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'getFile';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\File
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws TelegramBotsApi\Exceptions\Error
     * @throws \JsonException
     * @throws \JsonException
     */
    public function sendRequest(int $attempts = 1): TelegramBotsApi\Types\File
    {
        return new TelegramBotsApi\Types\File($this->request($attempts));
    }
}
