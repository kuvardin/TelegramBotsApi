<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about a change in auto-delete timer settings.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MessageAutoDeleteTimerChanged extends Type
{
    /**
     * @var int $message_auto_delete_time New auto-delete time for messages in the chat; in seconds
     */
    public int $message_auto_delete_time;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->message_auto_delete_time = $data['message_auto_delete_time'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'message_auto_delete_time' => $this->message_auto_delete_time,
        ];
    }
}
