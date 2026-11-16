<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes a TON wallet card, which is shown on the profile page of a user to everyone.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class TonWalletCard extends Type
{
    /**
     * @param string $address Address of the wallet
     * @param string $amount Balance of the wallet, in the "smallest units" of the cryptocurrency, as a decimal number
     * @param TonWalletCardSticker[] $stickers Stickers placed on the card
     * @param string|null $background_nft_address Address of the NFT of one of the stickers, whose colors must be used
     *     for the card background; omitted if the default background must be used
     */
    public function __construct(
        public string $address,
        public string $amount,
        public array $stickers,
        public ?string $background_nft_address = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            address: $data['address'],
            amount: $data['amount'],
            stickers: array_map(
                static fn(array $stickers_data) => TonWalletCardSticker::makeByArray($stickers_data),
                $data['stickers'],
            ),
            background_nft_address: $data['background_nft_address'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'address' => $this->address,
            'amount' => $this->amount,
            'stickers' => $this->stickers,
            'background_nft_address' => $this->background_nft_address,
        ];
    }
}

