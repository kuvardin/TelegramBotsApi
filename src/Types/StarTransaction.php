<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a Telegram Star transaction. Note that if the buyer initiates a chargeback with the payment provider
 * from whom they acquired Stars (e.g., Apple, Google) following this transaction, the refunded Stars will be deducted
 * from the bot's balance. This is outside of Telegram's control.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class StarTransaction extends Type
{
    /**
     * @param string $id Unique identifier of the transaction. Coincides with the identifer of the original transaction
     *     for refund transactions. Coincides with SuccessfulPayment.telegram_payment_charge_id for successful incoming
     *     payments from users.
     * @param int $amount Number of Telegram Stars transferred by the transaction
     * @param int $date Date the transaction was created in Unix time
     * @param TransactionPartner|null $source Source of an incoming transaction (e.g., a user purchasing goods or
     *     services, Fragment refunding a failed withdrawal). Only for incoming transactions
     * @param TransactionPartner|null $receiver Receiver of an outgoing transaction (e.g., a user for a purchase
     *     refund, Fragment for a withdrawal). Only for outgoing transactions
     * @param int|null $nanostar_amount The number of 1/1000000000 shares of Telegram Stars transferred
     *     by the transaction; from 0 to 999999999
     */
    public function __construct(
        public string $id,
        public int $amount,
        public int $date,
        public ?TransactionPartner $source = null,
        public ?TransactionPartner $receiver = null,
        public ?int $nanostar_amount = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            amount: $data['amount'],
            date: $data['date'],
            source: isset($data['source'])
                ? TransactionPartner::makeByArray($data['source'])
                : null,
            receiver: isset($data['receiver'])
                ? TransactionPartner::makeByArray($data['receiver'])
                : null,
            nanostar_amount: $data['nanostar_amount'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'date' => $this->date,
            'source' => $this->source,
            'receiver' => $this->receiver,
            'nanostar_amount' => $this->nanostar_amount,
        ];
    }
}
