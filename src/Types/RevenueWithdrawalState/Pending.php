<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RevenueWithdrawalState;

use Kuvardin\TelegramBotsApi\Types\RevenueWithdrawalState;
use RuntimeException;

/**
 * The withdrawal is in progress.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Pending extends RevenueWithdrawalState
{
    public function __construct()
    {

    }

    public static function getType(): string
    {
        return 'pending';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong revenue withdrawal state type: {$data['type']}");
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
