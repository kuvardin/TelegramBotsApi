<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\MessageOrigin;

use Kuvardin\TelegramBotsApi\Types\MessageOrigin;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\User as TelegramUser;
/**
 * The message was originally sent by a known user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class User extends MessageOrigin
{
    /**
     * @param int $date Date the message was sent originally in Unix time
     * @param TelegramUser $sender_user User that sent the message originally
     */
    public function __construct(
        public int $date,
        public TelegramUser $sender_user,
    )
    {

    }

    public static function getType(): string
    {
        return 'user';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong message origin type: {$data['type']}");
        }

        return new self(
            date: $data['date'],
            sender_user: TelegramUser::makeByArray($data['sender_user']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'date' => $this->date,
            'sender_user' => $this->sender_user,
        ];
    }
}