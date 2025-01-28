<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a message about the completion of a giveaway with public winners.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GiveawayWinners extends Type
{
    /**
     * @param Chat $chat The chat that created the giveaway
     * @param int $giveaway_message_id Identifier of the message with the giveaway in the chat
     * @param int $winners_selection_date Point in time (Unix timestamp) when winners of the giveaway were selected
     * @param int $winner_count Total number of winners in the giveaway
     * @param User[] $winners List of up to 100 winners of the giveaway
     * @param int|null $additional_chat_count The number of other chats the user had to join in order to be eligible
     *     for the giveaway
     * @param int|null $premium_subscription_month_count The number of months the Telegram Premium subscription won
     *     from the giveaway will be active for
     * @param int|null $unclaimed_prize_count Number of undistributed prizes
     * @param bool|null $only_new_members "True", if only users who had joined the chats after the giveaway started
     *     were eligible to win
     * @param bool|null $was_refunded "True", if the giveaway was canceled because the payment for it was refunded
     * @param string|null $prize_description Description of additional giveaway prize
     * @param int|null $prize_star_count The number of Telegram Stars that were split between giveaway winners;
     *     for Telegram Star giveaways only
     */
    public function __construct(
        public Chat $chat,
        public int $giveaway_message_id,
        public int $winners_selection_date,
        public int $winner_count,
        public array $winners,
        public ?int $additional_chat_count = null,
        public ?int $premium_subscription_month_count = null,
        public ?int $unclaimed_prize_count = null,
        public ?bool $only_new_members = null,
        public ?bool $was_refunded = null,
        public ?string $prize_description = null,
        public ?int $prize_star_count = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            chat: Chat::makeByArray($data['chat']),
            giveaway_message_id: $data['giveaway_message_id'],
            winners_selection_date: $data['winners_selection_date'],
            winner_count: $data['winner_count'],
            winners: array_map(
                static fn(array $winners_data) => User::makeByArray($winners_data),
                $data['winners'],
            ),
            additional_chat_count: $data['additional_chat_count'] ?? null,
            premium_subscription_month_count: $data['premium_subscription_month_count'] ?? null,
            unclaimed_prize_count: $data['unclaimed_prize_count'] ?? null,
            only_new_members: $data['only_new_members'] ?? null,
            was_refunded: $data['was_refunded'] ?? null,
            prize_description: $data['prize_description'] ?? null,
            prize_star_count: $data['prize_star_count'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'chat' => $this->chat,
            'giveaway_message_id' => $this->giveaway_message_id,
            'winners_selection_date' => $this->winners_selection_date,
            'winner_count' => $this->winner_count,
            'winners' => $this->winners,
            'additional_chat_count' => $this->additional_chat_count,
            'premium_subscription_month_count' => $this->premium_subscription_month_count,
            'unclaimed_prize_count' => $this->unclaimed_prize_count,
            'only_new_members' => $this->only_new_members,
            'was_refunded' => $this->was_refunded,
            'prize_description' => $this->prize_description,
            'prize_star_count' => $this->prize_star_count,
        ];
    }
}
