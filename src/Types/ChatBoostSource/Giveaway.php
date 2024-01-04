<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ChatBoostSource;

use Kuvardin\TelegramBotsApi\Types\ChatBoostSource;
use Kuvardin\TelegramBotsApi\Types\User;
use RuntimeException;

class Giveaway extends ChatBoostSource
{
    /**
     * @param int $giveaway_message_id Identifier of a message in the chat with the giveaway; the message could have
     *     been deleted already. May be 0 if the message isn't sent yet.
     * @param User|null $user User that won the prize in the giveaway if any
     * @param bool|null $is_unclaimed True, if the giveaway was completed, but there was no user to win the prize
     */
    public function __construct(
        public int $giveaway_message_id,
        public ?User $user = null,
        public ?bool $is_unclaimed = null,
    )
    {

    }

    public static function getSource(): string
    {
        return 'giveaway';
    }


    public static function makeByArray(array $data): static
    {
        if ($data['source'] !== self::getSource()) {
            throw new RuntimeException("Wrong chat boost source: {$data['source']}");
        }

        return new self(
            giveaway_message_id: $data['giveaway_message_id'],
            user: isset($data['user'])
                ? User::makeByArray($data['user'])
                : null,
            is_unclaimed: $data['is_unclaimed'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'source' => self::getSource(),
            'giveaway_message_id' => $this->giveaway_message_id,
            'user' => $this->user,
            'is_unclaimed' => $this->is_unclaimed,
        ];
    }
}