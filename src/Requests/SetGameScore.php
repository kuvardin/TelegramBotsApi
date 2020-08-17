<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Requests;

use Kuvardin\TelegramBotsApi;
use Kuvardin\TelegramBotsApi\Exceptions\Error;

/**
 * Class SetGameScore
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SetGameScore extends TelegramBotsApi\Request
{
    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'setGameScore';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\Message|null
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     */
    public function sendRequest(int $attempts = 1): ?TelegramBotsApi\Types\Message
    {
        $response = $this->request($attempts);
        if (!is_array($response)) {
            if ($response !== true) {
                $type = gettype($response);
                throw new Error("Incorrect response: $response typed $type (must be true)");
            }
            return null;
        }

        return new TelegramBotsApi\Types\Message($response);
    }
}
