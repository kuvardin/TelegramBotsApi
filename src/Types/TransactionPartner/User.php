<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\TransactionPartner;

use Kuvardin\TelegramBotsApi\Types\TransactionPartner;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\User as TelegramUser;
use Kuvardin\TelegramBotsApi\Types\AffiliateInfo;
use Kuvardin\TelegramBotsApi\Types\PaidMedia;
use Kuvardin\TelegramBotsApi\Types\Gift;

/**
 * Describes a transaction with a user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class User extends TransactionPartner
{
    /**
     * @param TelegramUser $user Information about the user
     * @param string|null $invoice_payload Bot-specified invoice payload
     * @param AffiliateInfo|null $affiliate Information about the affiliate that received a commission via this
     *     transaction
     * @param int|null $subscription_period The duration of the paid subscription
     * @param PaidMedia[]|null $paid_media Information about the paid media bought by the user
     * @param string|null $paid_media_payload Bot-specified paid media payload
     * @param Gift|null $gift The gift sent to the user by the bot
     */
    public function __construct(
        public TelegramUser $user,
        public ?string $invoice_payload = null,
        public ?AffiliateInfo $affiliate = null,
        public ?int $subscription_period = null,
        public ?array $paid_media = null,
        public ?string $paid_media_payload = null,
        public ?Gift $gift = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'user';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong transaction partner type: {$data['type']}");
        }

        return new self(
            user: TelegramUser::makeByArray($data['user']),
            invoice_payload: $data['invoice_payload'] ?? null,
            affiliate: isset($data['affiliate'])
                ? AffiliateInfo::makeByArray($data['affiliate'])
                : null,
            subscription_period: $data['subscription_period'] ?? null,
            paid_media: isset($data['paid_media'])
                ? array_map(
                    static fn(array $paid_media_data) => PaidMedia::makeByArray($paid_media_data),
                    $data['paid_media'],
                )
                : null,
            paid_media_payload: $data['paid_media_payload'] ?? null,
            gift: isset($data['gift'])
                ? Gift::makeByArray($data['gift'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'user' => $this->user,
            'invoice_payload' => $this->invoice_payload,
            'affiliate' => $this->affiliate,
            'subscription_period' => $this->subscription_period,
            'paid_media' => $this->paid_media,
            'paid_media_payload' => $this->paid_media_payload,
            'gift' => $this->gift,
        ];
    }
}
