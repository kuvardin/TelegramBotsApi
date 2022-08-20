<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a unique message identifier.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MessageId extends Type
{
    /**
     * @var int $message_id Unique message identifier
     */
    public int $message_id;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->message_id = $data['message_id'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'message_id' => $this->message_id,
        ];
    }
}
