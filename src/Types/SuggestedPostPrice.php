<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes the price of a suggested post.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SuggestedPostPrice extends Type
{
    /**
     * @param string $currency Currency in which the post will be paid. Currently, must be one of “XTR” for Telegram
     *     Stars or “TON” for toncoins
     * @param int $amount The amount of the currency that will be paid for the post in the "smallest units" of the
     *     currency, i.e. Telegram Stars or nanotoncoins. Currently, price in Telegram Stars must be between 5 and
     *     100000, and price in nanotoncoins must be between 10000000 and 10000000000000.
     */
    public function __construct(
        public string $currency,
        public int $amount,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            currency: $data['currency'],
            amount: $data['amount'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'currency' => $this->currency,
            'amount' => $this->amount,
        ];
    }
}
