<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\MessageOrigin;

use Kuvardin\TelegramBotsApi\Types\MessageOrigin;
use RuntimeException;

/**
 * The message was originally sent by an unknown user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class HiddenUser extends MessageOrigin
{
    /**
     * @param int $date Date the message was sent originally in Unix time
     * @param string $sender_user_name Name of the user that sent the message originally
     */
    public function __construct(
        public int $date,
        public string $sender_user_name,
    )
    {

    }

    public static function getType(): string
    {
        return 'hidden_user';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong message origin type: {$data['type']}");
        }

        return new self(
            date: $data['date'],
            sender_user_name: $data['sender_user_name'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'date' => $this->date,
            'sender_user_name' => $this->sender_user_name,
        ];
    }
}