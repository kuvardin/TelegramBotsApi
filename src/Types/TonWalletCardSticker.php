<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes a sticker on a TON wallet card.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class TonWalletCardSticker extends Type
{
    /**
     * @param AreaPosition $position Position of the sticker on the card
     * @param TonNft $nft The NFT shown as the sticker
     */
    public function __construct(
        public AreaPosition $position,
        public TonNft $nft,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            position: AreaPosition::makeByArray($data['position']),
            nft: TonNft::makeByArray($data['nft']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'position' => $this->position,
            'nft' => $this->nft,
        ];
    }
}

