<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\TransactionPartner;

use Kuvardin\TelegramBotsApi\Types\TransactionPartner;
use RuntimeException;

/**
 * Describes a withdrawal transaction to the Telegram Ads platform.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class TelegramAds extends TransactionPartner
{
    public function __construct()
    {

    }

    public static function getType(): string
    {
        return 'telegram_ads';
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
