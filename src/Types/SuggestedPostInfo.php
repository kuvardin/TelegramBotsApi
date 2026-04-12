<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\SuggestedPostState;
use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains information about a suggested post.
Contains information about a suggested post.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SuggestedPostInfo extends Type
{
    /**
     * @param SuggestedPostState|string $state_value State of the suggested post.
     * @param SuggestedPostPrice|null $price Proposed price of the post. If the field is omitted, then the post is
     *     unpaid.
     * @param int|null $send_date Proposed send date of the post. If the field is omitted, then the post can be
     *     published at any time within 30 days at the sole discretion of the user or administrator who approves it.
     */
    public function __construct(
        public SuggestedPostState|string $state_value,
        public ?SuggestedPostPrice $price = null,
        public ?int $send_date = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            state_value: $data['state'],
            price: isset($data['price'])
                ? SuggestedPostPrice::makeByArray($data['price'])
                : null,
            send_date: $data['send_date'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'state' => $this->state_value,
            'price' => $this->price,
            'send_date' => $this->send_date,
        ];
    }

    /**
     * @return SuggestedPostState|null Returns Null if the suggested post state value is unknown.
     */
    public function getState(): ?SuggestedPostState
    {
        return is_string($this->state_value)
            ? SuggestedPostState::tryFrom($this->state_value)
            : null;
    }
}
