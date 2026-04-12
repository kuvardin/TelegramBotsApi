<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about a regular gift that was sent or received.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class GiftInfo extends Type
{
    /**
     * @param Gift $gift Information about the gift
     * @param string|null $owned_gift_id Unique identifier of the received gift for the bot; only present for gifts
     *     received on behalf of business accounts
     * @param int|null $convert_star_count Number of Telegram Stars that can be claimed by the receiver by converting
     *     the gift; omitted if conversion to Telegram Stars is impossible
     * @param int|null $prepaid_upgrade_star_count Number of Telegram Stars that were prepaid for the ability to upgrade
     *     the gift
     * @param bool|null $is_upgrade_separate True, if the gift's upgrade was purchased after the gift was sent
     * @param bool|null $can_be_upgraded True, if the gift can be upgraded to a unique gift
     * @param string|null $text Text of the message that was added to the gift
     * @param MessageEntity[]|null $entities Special entities that appear in the text
     * @param bool|null $is_private True, if the sender and gift text are shown only to the gift receiver; otherwise,
     *     everyone will be able to see them
     * @param int|null $unique_gift_number Unique number reserved for this gift when upgraded. See the number field in
     *     UniqueGift
     */
    public function __construct(
        public Gift $gift,
        public ?string $owned_gift_id = null,
        public ?int $convert_star_count = null,
        public ?int $prepaid_upgrade_star_count = null,
        public ?bool $is_upgrade_separate = null,
        public ?bool $can_be_upgraded = null,
        public ?string $text = null,
        public ?array $entities = null,
        public ?bool $is_private = null,
        public ?int $unique_gift_number = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            gift: Gift::makeByArray($data['gift']),
            owned_gift_id: $data['owned_gift_id'] ?? null,
            convert_star_count: $data['convert_star_count'] ?? null,
            prepaid_upgrade_star_count: $data['prepaid_upgrade_star_count'] ?? null,
            is_upgrade_separate: $data['is_upgrade_separate'] ?? null,
            can_be_upgraded: $data['can_be_upgraded'] ?? null,
            text: $data['text'] ?? null,
            entities: isset($data['entities'])
                ? array_map(
                    static fn(array $entity_data) => MessageEntity::makeByArray($entity_data),
                    $data['entities'],
                )
                : null,
            is_private: $data['is_private'] ?? null,
            unique_gift_number: $data['unique_gift_number'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'gift' => $this->gift,
            'owned_gift_id' => $this->owned_gift_id,
            'convert_star_count' => $this->convert_star_count,
            'prepaid_upgrade_star_count' => $this->prepaid_upgrade_star_count,
            'is_upgrade_separate' => $this->is_upgrade_separate,
            'can_be_upgraded' => $this->can_be_upgraded,
            'text' => $this->text,
            'entities' => $this->entities,
            'is_private' => $this->is_private,
            'unique_gift_number' => $this->unique_gift_number,
        ];
    }
}
