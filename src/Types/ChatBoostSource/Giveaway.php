<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ChatBoostSource;

use Kuvardin\TelegramBotsApi\Types\ChatBoostSource;
use Kuvardin\TelegramBotsApi\Types\User;
use RuntimeException;

/**
 * The boost was obtained by the creation of a Telegram Premium or a Telegram Star giveaway. This boosts the chat
 * 4 times for the duration of the corresponding Telegram Premium subscription for Telegram Premium giveaways and
 * "prize_star_count" / 500 times for one year for Telegram Star giveaways.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Giveaway extends ChatBoostSource
{
    /**
     * @param int $giveaway_message_id Identifier of a message in the chat with the giveaway; the message could have
     *     been deleted already. May be 0 if the message isn't sent yet.
     * @param User|null $user User that won the prize in the giveaway if any
     * @param bool|null $is_unclaimed True, if the giveaway was completed, but there was no user to win the prize
     * @param int|null $prize_star_count The number of Telegram Stars to be split between giveaway winners;
     *     for Telegram Star giveaways only
     */
    public function __construct(
        public int $giveaway_message_id,
        public ?User $user = null,
        public ?bool $is_unclaimed = null,
        public ?int $prize_star_count = null,
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
            prize_star_count: $data['prize_star_count'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'source' => self::getSource(),
            'giveaway_message_id' => $this->giveaway_message_id,
            'user' => $this->user,
            'is_unclaimed' => $this->is_unclaimed,
            'prize_star_count' => $this->prize_star_count,
        ];
    }
}