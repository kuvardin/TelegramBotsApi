<?php declare(strict_types=1);

namespace TelegramBotsApi\Requests;

use TelegramBotsApi;

/**
 * Class GetChatAdministrators
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GetChatAdministrators extends TelegramBotsApi\Request
{
    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'getChatAdministrators';
    }

    /**
     * @param int $attempts
     * @return TelegramBotsApi\Types\ChatMember[]
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public function sendRequest(int $attempts = 1): array
    {
        $result = [];
        $response = $this->request($attempts);
        foreach ($response as $chat_member_data) {
            $result[] = new TelegramBotsApi\Types\ChatMember($chat_member_data);
        }
        return $result;
    }
}