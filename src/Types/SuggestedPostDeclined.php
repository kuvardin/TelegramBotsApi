<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about the rejection of a suggested post.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SuggestedPostDeclined extends Type
{
    /**
     * @param Message|null $suggested_post_message Message containing the suggested post. Note that the Message object
     *     in this field will not contain the "reply_to_message" field even if it itself is a reply.
     * @param string|null $comment Comment with which the post was declined
     */
    public function __construct(
        public ?Message $suggested_post_message = null,
        public ?string $comment = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            suggested_post_message: isset($data['suggested_post_message'])
                ? Message::makeByArray($data['suggested_post_message'])
                : null,
            comment: $data['comment'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'suggested_post_message' => $this->suggested_post_message,
            'comment' => $this->comment,
        ];
    }
}
