<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\TransactionPartner;

use Kuvardin\TelegramBotsApi\Types\TransactionPartner;
use Kuvardin\TelegramBotsApi\Types\User as TelegramUser;
use RuntimeException;

/**
 * Describes the affiliate program that issued the affiliate commission received via this transaction.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class AffiliateProgram extends TransactionPartner
{
    /**
     * @param int $commission_per_mille The number of Telegram Stars received by the bot for each 1000 Telegram Stars
     *     received by the affiliate program sponsor from referred users
     * @param TelegramUser|null $sponsor_user Information about the bot that sponsored the affiliate program
     */
    public function __construct(
        public int $commission_per_mille,
        public ?TelegramUser $sponsor_user = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'affiliate_program';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong transaction partner type: {$data['type']}");
        }

        return new self(
            commission_per_mille: $data['commission_per_mille'],
            sponsor_user: isset($data['sponsor_user'])
                ? TelegramUser::makeByArray($data['sponsor_user'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'sponsor_user' => $this->sponsor_user,
            'commission_per_mille' => $this->commission_per_mille,
        ];
    }
}
