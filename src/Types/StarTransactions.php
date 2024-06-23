<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains a list of Telegram Star transactions.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class StarTransactions extends Type
{
    /**
     * @param StarTransaction[] $transactions The list of transactions
     */
    public function __construct(
        public array $transactions,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            transactions: array_map(
                static fn(array $transactions_data) => StarTransaction::makeByArray($transactions_data),
                $data['transactions'],
            ),
        );
    }

    public function getRequestData(): array
    {
        return [
            'transactions' => $this->transactions,
        ];
    }
}
