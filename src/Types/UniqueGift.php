<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes a unique gift that was upgraded from a regular gift.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UniqueGift extends Type
{
    /**
     * @param string $gift_id Identifier of the regular gift from which the gift was upgraded
     * @param string $base_name Human-readable name of the regular gift from which this unique gift was upgraded
     * @param string $name Unique name of the gift. This name can be used in <code>https://t.me/nft/...</code> links and
     *     story areas
     * @param int $number Unique number of the upgraded gift among gifts upgraded from the same regular gift
     * @param UniqueGiftModel $model Model of the gift
     * @param UniqueGiftSymbol $symbol Symbol of the gift
     * @param UniqueGiftBackdrop $backdrop Backdrop of the gift
     * @param bool|null $is_premium True, if the original regular gift was exclusively purchaseable by Telegram Premium
     *     subscribers
     * @param bool|null $is_burned True, if the gift was used to craft another gift and isn't available anymore
     * @param bool|null $is_from_blockchain True, if the gift is assigned from the TON blockchain and can't be resold or
     *     transferred in Telegram
     * @param UniqueGiftColors|null $colors The color scheme that can be used by the gift's owner for the chat's name,
     *     replies to messages and link previews; for business account gifts and gifts that are currently on sale only
     * @param Chat|null $publisher_chat Information about the chat that published the gift
     */
    public function __construct(
        public string $gift_id,
        public string $base_name,
        public string $name,
        public int $number,
        public UniqueGiftModel $model,
        public UniqueGiftSymbol $symbol,
        public UniqueGiftBackdrop $backdrop,
        public ?bool $is_premium = null,
        public ?bool $is_burned = null,
        public ?bool $is_from_blockchain = null,
        public ?UniqueGiftColors $colors = null,
        public ?Chat $publisher_chat = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            gift_id: $data['gift_id'],
            base_name: $data['base_name'],
            name: $data['name'],
            number: $data['number'],
            model: UniqueGiftModel::makeByArray($data['model']),
            symbol: UniqueGiftSymbol::makeByArray($data['symbol']),
            backdrop: UniqueGiftBackdrop::makeByArray($data['backdrop']),
            is_premium: $data['is_premium'] ?? null,
            is_burned: $data['is_burned'] ?? null,
            is_from_blockchain: $data['is_from_blockchain'] ?? null,
            colors: isset($data['colors'])
                ? UniqueGiftColors::makeByArray($data['colors'])
                : null,
            publisher_chat: isset($data['publisher_chat'])
                ? Chat::makeByArray($data['publisher_chat'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'gift_id' => $this->gift_id,
            'base_name' => $this->base_name,
            'name' => $this->name,
            'number' => $this->number,
            'model' => $this->model,
            'symbol' => $this->symbol,
            'backdrop' => $this->backdrop,
            'is_premium' => $this->is_premium,
            'is_burned' => $this->is_burned,
            'is_from_blockchain' => $this->is_from_blockchain,
            'colors' => $this->colors,
            'publisher_chat' => $this->publisher_chat,
        ];
    }
}
