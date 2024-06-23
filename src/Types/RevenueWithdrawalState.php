<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes the state of a revenue withdrawal operation.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class RevenueWithdrawalState extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            RevenueWithdrawalState\Failed::getType() => RevenueWithdrawalState\Failed::makeByArray($data),
            RevenueWithdrawalState\Pending::getType() => RevenueWithdrawalState\Pending::makeByArray($data),
            RevenueWithdrawalState\Succeeded::getType() => RevenueWithdrawalState\Succeeded::makeByArray($data),
            default => throw new RuntimeException("Unknown revenue withdrawal state type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}
