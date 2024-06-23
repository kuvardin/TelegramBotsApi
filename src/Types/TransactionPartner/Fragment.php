<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\TransactionPartner;

use Kuvardin\TelegramBotsApi\Types\RevenueWithdrawalState;
use Kuvardin\TelegramBotsApi\Types\TransactionPartner;
use RuntimeException;

/**
 * Describes a withdrawal transaction with Fragment.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Fragment extends TransactionPartner
{
    /**
     * @param RevenueWithdrawalState|null $withdrawal_state State of the transaction if the transaction is outgoing
     */
    public function __construct(
        public ?RevenueWithdrawalState $withdrawal_state = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'fragment';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong transaction partner type: {$data['type']}");
        }

        return new self(
            withdrawal_state: isset($data['withdrawal_state'])
                ? RevenueWithdrawalState::makeByArray($data['withdrawal_state'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'withdrawal_state' => $this->withdrawal_state,
        ];
    }
}
