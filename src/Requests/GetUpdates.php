<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;

/**
 * Class GetUpdates
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GetUpdates extends TelegramBotsApi\Request
{
    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'getUpdates';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\Update[]
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws TelegramBotsApi\Exceptions\Error
     * @throws \JsonException
     * @throws \JsonException
     */
    public function sendRequest(int $attempts = 1): array
    {
        $result = [];
        $response = $this->request($attempts);
        foreach ($response as $update_data) {
            $result[] = new TelegramBotsApi\Types\Update($update_data);
        }
        return $result;
    }
}
