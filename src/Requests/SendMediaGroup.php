<?php declare(strict_types=1);

namespace TelegramBotsApi\Requests;

use TelegramBotsApi;

/**
 * Class SendMediaGroup
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SendMediaGroup extends TelegramBotsApi\Request
{
    use Traits\NotificationDisablingEdit;
    use Traits\ReplyToMessageEdit;

    /**
     * @return string
     */
    public static function getApiMethodName(): string
    {
        return 'sendMediaGroup';
    }

    /**
     * @param int $attempts
     * @return array
     * @throws TelegramBotsApi\Exceptions\ApiError
     * @throws TelegramBotsApi\Exceptions\CurlError
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public function sendRequest(int $attempts = 1): array
    {
        $result = [];
        $response = $this->request($attempts);
        foreach ($response as $message_data) {
            $result[] = new TelegramBotsApi\Types\Message($message_data);
        }
        return $result;
    }
}