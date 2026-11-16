<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\SubscriptionState;
use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about changes to a user payment subscription toward the current bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BotSubscriptionUpdated extends Type
{
    /**
     * @param User $user User who subscribed for payments toward the bot
     * @param string $invoice_payload Bot-specified invoice payload
     * @param string $state_value The new state of the subscription. Currently, it can be one of “canceled” if the user
     *     canceled the subscription, “active” if the user re-enabled a previously canceled subscription, or “failed”
     *     if payment for the subscription failed.
     */
    public function __construct(
        public User $user,
        public string $invoice_payload,
        public string $state_value,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            user: User::makeByArray($data['user']),
            invoice_payload: $data['invoice_payload'],
            state_value: $data['state'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'user' => $this->user,
            'invoice_payload' => $this->invoice_payload,
            'state' => $this->state_value,
        ];
    }

    public function getState(): ?SubscriptionState
    {
        return SubscriptionState::tryFrom($this->state_value);
    }
}
