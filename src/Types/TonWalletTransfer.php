<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about a transfer with a TON wallet.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class TonWalletTransfer extends Type
{
    /**
     * @param string $transaction_id Unique identifier of the transaction; may be empty if the transfer hasn't been
     *     sent yet
     * @param string $peer_address Address of the transfer peer in the TON blockchain
     * @param string $amount The amount of transferred cryptocurrency, in the "smallest units" of the cryptocurrency,
     *     as a decimal number; negative for outgoing transfers
     * @param string|null $comment Comment added to the transfer; omitted if the comment is encrypted
     */
    public function __construct(
        public string $transaction_id,
        public string $peer_address,
        public string $amount,
        public ?string $comment = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            transaction_id: $data['transaction_id'],
            peer_address: $data['peer_address'],
            amount: $data['amount'],
            comment: $data['comment'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'transaction_id' => $this->transaction_id,
            'peer_address' => $this->peer_address,
            'amount' => $this->amount,
            'comment' => $this->comment,
        ];
    }
}





