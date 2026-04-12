<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes an amount of Telegram Stars.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class StarAmount extends Type
{
    /**
     * @param int $amount Integer amount of Telegram Stars, rounded to 0; can be negative
     * @param int|null $nanostar_amount The number of 1/1000000000 shares of Telegram Stars; from -999999999 to
     *     999999999; can be negative if and only if "amount" is non-positive
     */
    public function __construct(
        public int $amount,
        public ?int $nanostar_amount = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            amount: $data['amount'],
            nanostar_amount: $data['nanostar_amount'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'amount' => $this->amount,
            'nanostar_amount' => $this->nanostar_amount,
        ];
    }
}
