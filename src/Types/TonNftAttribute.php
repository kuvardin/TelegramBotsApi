<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an attribute of an NFT in the TON blockchain.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class TonNftAttribute extends Type
{
    /**
     * @param string $trait_type Trait type of the attribute
     * @param string $value Value of the attribute
     */
    public function __construct(
        public string $trait_type,
        public string $value,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            trait_type: $data['trait_type'],
            value: $data['value'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'trait_type' => $this->trait_type,
            'value' => $this->value,
        ];
    }
}





