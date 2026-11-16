<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an NFT in the TON blockchain.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class TonNft extends Type
{
    /**
     * @param string $address Address of the NFT
     * @param string $index Index of the NFT among all NFTs from the collection as a decimal number
     * @param string $name Name of the NFT
     * @param string $description Description of the NFT
     * @param string|null $collection_address Address of the collection to which the NFT belongs; omitted if unknown
     * @param TonNftAttribute[]|null $attributes Attributes of the NFT
     * @param UniqueGift|null $gift The unique gift corresponding to the NFT
     */
    public function __construct(
        public string $address,
        public string $index,
        public string $name,
        public string $description,
        public ?string $collection_address = null,
        public ?array $attributes = null,
        public ?UniqueGift $gift = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            address: $data['address'],
            index: $data['index'],
            name: $data['name'],
            description: $data['description'],
            collection_address: $data['collection_address'] ?? null,
            attributes: isset($data['attributes'])
                ? array_map(
                    static fn(array $attributes_data) => TonNftAttribute::makeByArray($attributes_data),
                    $data['attributes'],
                )
                : null,
            gift: isset($data['gift'])
                ? UniqueGift::makeByArray($data['gift'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'address' => $this->address,
            'index' => $this->index,
            'name' => $this->name,
            'description' => $this->description,
            'collection_address' => $this->collection_address,
            'attributes' => $this->attributes,
            'gift' => $this->gift,
        ];
    }
}

