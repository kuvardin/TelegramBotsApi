<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;

/**
 * Class GetStickerSet
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GetStickerSet extends TelegramBotsApi\Request
{
    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'getStickerSet';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\StickerSet
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public function sendRequest(int $attempts = 1): TelegramBotsApi\Types\StickerSet
    {
        return new TelegramBotsApi\Types\StickerSet($this->request($attempts));
    }
}
