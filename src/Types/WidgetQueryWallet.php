<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes a TON wallet of the user, which is used in a query from a widget.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class WidgetQueryWallet extends Type
{
    /**
     * @param string $address Address of the wallet
     * @param string $amount Balance of the wallet, in the "smallest units" of the cryptocurrency, as a decimal number
     * @param string|null $public_key Hex-encoded public key of the wallet; omitted if unknown
     * @param string|null $state_init Base64-encoded serialized StateInit of the wallet contract; omitted if and only
     *     if "public_key" is omitted
     */
    public function __construct(
        public string $address,
        public string $amount,
        public string|null $public_key = null,
        public string|null $state_init = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            address: $data['address'],
            amount: $data['amount'],
            public_key: $data['public_key'] ?? null,
            state_init: $data['state_init'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'address' => $this->address,
            'amount' => $this->amount,
            'public_key' => $this->public_key,
            'state_init' => $this->state_init,
        ];
    }
}





