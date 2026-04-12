<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about a successful payment for a suggested post.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SuggestedPostPaid extends Type
{
    /**
     * @param string $currency Currency in which the payment was made. Currently, one of “XTR” for Telegram Stars or
     *     “TON” for toncoins
     * @param Message|null $suggested_post_message Message containing the suggested post. Note that the Message object
     *     in this field will not contain the "reply_to_message" field even if it itself is a reply.
     * @param int|null $amount The amount of the currency that was received by the channel in nanotoncoins; for payments
     *     in toncoins only
     * @param StarAmount|null $star_amount The amount of Telegram Stars that was received by the channel; for payments
     *     in Telegram Stars only
     */
    public function __construct(
        public string $currency,
        public ?Message $suggested_post_message = null,
        public ?int $amount = null,
        public ?StarAmount $star_amount = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            currency: $data['currency'],
            suggested_post_message: isset($data['suggested_post_message'])
                ? Message::makeByArray($data['suggested_post_message'])
                : null,
            amount: $data['amount'] ?? null,
            star_amount: isset($data['star_amount'])
                ? StarAmount::makeByArray($data['star_amount'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'currency' => $this->currency,
            'suggested_post_message' => $this->suggested_post_message,
            'amount' => $this->amount,
            'star_amount' => $this->star_amount,
        ];
    }
}
