<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains parameters of a post that is being suggested by the bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SuggestedPostParameters extends Type
{
    /**
     * @param SuggestedPostPrice|null $price Proposed price for the post. If the field is omitted, then the post is
     *     unpaid.
     * @param int|null $send_date Proposed send date of the post. If specified, then the date must be between 300 second
     *     and 2678400 seconds (30 days) in the future. If the field is omitted, then the post can be published at any
     *     time within 30 days at the sole discretion of the user who approves it.
     */
    public function __construct(
        public ?SuggestedPostPrice $price = null,
        public ?int $send_date = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            price: isset($data['price'])
                ? SuggestedPostPrice::makeByArray($data['price'])
                : null,
            send_date: $data['send_date'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'price' => $this->price,
            'send_date' => $this->send_date,
        ];
    }
}
