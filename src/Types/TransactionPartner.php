<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes the source of a transaction, or its recipient for outgoing transactions.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class TransactionPartner extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            TransactionPartner\Fragment::getType() => TransactionPartner\Fragment::makeByArray($data),
            TransactionPartner\Other::getType() => TransactionPartner\Other::makeByArray($data),
            TransactionPartner\User::getType() => TransactionPartner\User::makeByArray($data),
            default => throw new RuntimeException("Wrong transaction partner type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}
