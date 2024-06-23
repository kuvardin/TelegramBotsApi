<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\TransactionPartner;

use Kuvardin\TelegramBotsApi\Types\TransactionPartner;
use RuntimeException;

/**
 * Describes a transaction with an unknown source or recipient.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Other extends TransactionPartner
{
    public function __construct()
    {

    }

    public static function getType(): string
    {
        return 'other';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong transaction partner type: {$data['type']}");
        }

        return new self();
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
        ];
    }
}
