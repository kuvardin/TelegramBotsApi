<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a service message about the failed approval of a suggested post. Currently, only caused by insufficient
 * user funds at the time of approval.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SuggestedPostApprovalFailed extends Type
{
    /**
     * @param SuggestedPostPrice $price Expected price of the post
     * @param Message|null $suggested_post_message Message containing the suggested post whose approval has failed.
     *     Note that the Message object in this field will not contain the "reply_to_message" field even if it itself
     *     is a reply.
     */
    public function __construct(
        public SuggestedPostPrice $price,
        public ?Message $suggested_post_message = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            price: SuggestedPostPrice::makeByArray($data['price']),
            suggested_post_message: isset($data['suggested_post_message'])
                ? Message::makeByArray($data['suggested_post_message'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'price' => $this->price,
            'suggested_post_message' => $this->suggested_post_message,
        ];
    }
}
