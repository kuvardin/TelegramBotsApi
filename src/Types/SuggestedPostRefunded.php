<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about a payment refund for a suggested post.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SuggestedPostRefunded extends Type
{
    /**
     * @param string $reason Reason for the refund. Currently, one of “post_deleted” if the post was deleted within
     *     24 hours of being posted or removed from scheduled messages without being posted, or “payment_refunded” if
     *     the payer refunded their payment.
     * @param Message|null $suggested_post_message Message containing the suggested post. Note that the Message object
     *     in this field will not contain the "reply_to_message" field even if it itself is a reply.
     */
    public function __construct(
        public string $reason,
        public ?Message $suggested_post_message = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            reason: $data['reason'],
            suggested_post_message: isset($data['suggested_post_message'])
                ? Message::makeByArray($data['suggested_post_message'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'reason' => $this->reason,
            'suggested_post_message' => $this->suggested_post_message,
        ];
    }
}
