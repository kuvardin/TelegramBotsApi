<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about the approval of a suggested post.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SuggestedPostApproved extends Type
{
    /**
     * @param int $send_date Date when the post will be published
     * @param Message|null $suggested_post_message Message containing the suggested post. Note that the Message object
     *     in this field will not contain the "reply_to_message" field even if it itself is a reply.
     * @param SuggestedPostPrice|null $price Amount paid for the post
     */
    public function __construct(
        public int $send_date,
        public ?Message $suggested_post_message = null,
        public ?SuggestedPostPrice $price = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            send_date: $data['send_date'],
            suggested_post_message: isset($data['suggested_post_message'])
                ? Message::makeByArray($data['suggested_post_message'])
                : null,
            price: isset($data['price'])
                ? SuggestedPostPrice::makeByArray($data['price'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'send_date' => $this->send_date,
            'suggested_post_message' => $this->suggested_post_message,
            'price' => $this->price,
        ];
    }
}
