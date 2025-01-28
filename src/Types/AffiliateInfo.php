<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains information about the affiliate that received a commission via this transaction.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class AffiliateInfo extends Type
{
    /**
     * @param int $commission_per_mille The number of Telegram Stars received by the affiliate for each 1000 Telegram
     *     Stars received by the bot from referred users
     * @param int $amount Integer amount of Telegram Stars received by the affiliate from the transaction, rounded to 0;
     *     can be negative for refunds
     * @param User|null $affiliate_user The bot or the user that received an affiliate commission if it was received by
     *     a bot or a user
     * @param Chat|null $affiliate_chat The chat that received an affiliate commission if it was received by a chat
     * @param int|null $nanostar_amount The number of 1/1000000000 shares of Telegram Stars received by the affiliate;
     *     from -999999999 to 999999999; can be negative for refunds
     */
    public function __construct(
        public int $commission_per_mille,
        public int $amount,
        public ?User $affiliate_user = null,
        public ?Chat $affiliate_chat = null,
        public ?int $nanostar_amount = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            commission_per_mille: $data['commission_per_mille'],
            amount: $data['amount'],
            affiliate_user: isset($data['affiliate_user'])
				? User::makeByArray($data['affiliate_user'])
				: null,
            affiliate_chat: isset($data['affiliate_chat'])
				? Chat::makeByArray($data['affiliate_chat'])
				: null,
            nanostar_amount: $data['nanostar_amount'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'affiliate_user' => $this->affiliate_user,
            'affiliate_chat' => $this->affiliate_chat,
            'commission_per_mille' => $this->commission_per_mille,
            'amount' => $this->amount,
            'nanostar_amount' => $this->nanostar_amount,
        ];
    }
}
