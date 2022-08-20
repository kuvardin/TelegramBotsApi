<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;
use Kuvardin\TelegramBotsApi\Request;
use Kuvardin\TelegramBotsApi\Types\File;

/**
 * In response to this request, File object will be received.
 *
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RequestFile extends Request
{
    /**
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    public function sendRequest(int $attempts = 1): File
    {
        return File::makeByArray($this->request($attempts));
    }
}