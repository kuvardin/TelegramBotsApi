<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\OwnedGift;

use Kuvardin\TelegramBotsApi\Types\Gift;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;
use Kuvardin\TelegramBotsApi\Types\OwnedGift;
use Kuvardin\TelegramBotsApi\Types\User;
use RuntimeException;

/**
 * Describes a regular gift owned by a user or a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Regular extends OwnedGift
{
    /**
     * @param Gift $gift Information about the regular gift
     * @param int $send_date Date the gift was sent in Unix time
     * @param string|null $owned_gift_id Unique identifier of the gift for the bot; for gifts received on behalf of
     *     business accounts only
     * @param User|null $sender_user Sender of the gift if it is a known user
     * @param string|null $text Text of the message that was added to the gift
     * @param MessageEntity[]|null $entities Special entities that appear in the text
     * @param bool|null $is_private True, if the sender and gift text are shown only to the gift receiver; otherwise,
     *     everyone will be able to see them
     * @param bool|null $is_saved True, if the gift is displayed on the account's profile page; for gifts received on
     *     behalf of business accounts only
     * @param bool|null $can_be_upgraded True, if the gift can be upgraded to a unique gift; for gifts received on
     *     behalf of business accounts only
     * @param bool|null $was_refunded True, if the gift was refunded and isn't available anymore
     * @param int|null $convert_star_count Number of Telegram Stars that can be claimed by the receiver instead of the
     *     gift; omitted if the gift cannot be converted to Telegram Stars; for gifts received on behalf of business
     *     accounts only
     * @param int|null $prepaid_upgrade_star_count Number of Telegram Stars that were paid for the ability to upgrade
     *     the gift
     * @param bool|null $is_upgrade_separate True, if the gift's upgrade was purchased after the gift was sent; for
     *     gifts received on behalf of business accounts only
     * @param int|null $unique_gift_number Unique number reserved for this gift when upgraded. See the "number" field
     *     in UniqueGift
     */
    public function __construct(
        public Gift $gift,
        public int $send_date,
        public ?string $owned_gift_id = null,
        public ?User $sender_user = null,
        public ?string $text = null,
        public ?array $entities = null,
        public ?bool $is_private = null,
        public ?bool $is_saved = null,
        public ?bool $can_be_upgraded = null,
        public ?bool $was_refunded = null,
        public ?int $convert_star_count = null,
        public ?int $prepaid_upgrade_star_count = null,
        public ?bool $is_upgrade_separate = null,
        public ?int $unique_gift_number = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'regular';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong owned gift type: {$data['type']}");
        }

        return new self(
            gift: Gift::makeByArray($data['gift']),
            send_date: $data['send_date'],
            owned_gift_id: $data['owned_gift_id'] ?? null,
            sender_user: isset($data['sender_user'])
                ? User::makeByArray($data['sender_user'])
                : null,
            text: $data['text'] ?? null,
            entities: isset($data['entities'])
                ? array_map(
                    static fn(array $entity_data) => MessageEntity::makeByArray($entity_data),
                    $data['entities'],
                )
                : null,
            is_private: $data['is_private'] ?? null,
            is_saved: $data['is_saved'] ?? null,
            can_be_upgraded: $data['can_be_upgraded'] ?? null,
            was_refunded: $data['was_refunded'] ?? null,
            convert_star_count: $data['convert_star_count'] ?? null,
            prepaid_upgrade_star_count: $data['prepaid_upgrade_star_count'] ?? null,
            is_upgrade_separate: $data['is_upgrade_separate'] ?? null,
            unique_gift_number: $data['unique_gift_number'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'gift' => $this->gift,
            'send_date' => $this->send_date,
            'owned_gift_id' => $this->owned_gift_id,
            'sender_user' => $this->sender_user,
            'text' => $this->text,
            'entities' => $this->entities,
            'is_private' => $this->is_private,
            'is_saved' => $this->is_saved,
            'can_be_upgraded' => $this->can_be_upgraded,
            'was_refunded' => $this->was_refunded,
            'convert_star_count' => $this->convert_star_count,
            'prepaid_upgrade_star_count' => $this->prepaid_upgrade_star_count,
            'is_upgrade_separate' => $this->is_upgrade_separate,
            'unique_gift_number' => $this->unique_gift_number,
        ];
    }
}
