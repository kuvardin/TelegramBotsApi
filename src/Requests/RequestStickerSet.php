<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;
use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\StickerSet;

/**
 * In response to this request, StickerSet object will be received.
 *
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestStickerSet extends Request
{
    /**
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    public function sendRequest(int $attempts = 1): StickerSet
    {
        return StickerSet::makeByArray($this->request($attempts));
    }
}