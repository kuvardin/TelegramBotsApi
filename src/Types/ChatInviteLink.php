<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Represents an invite link for a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatInviteLink extends Type
{
    /**
     * @param string $invite_link The invite link. If the link was created by another chat administrator, then the
     *     second part of the link will be replaced with “…”.
     * @param User $creator Creator of the link
     * @param bool $creates_join_request True, if users joining the chat via the link need to be approved by
     *     chat administrators
     * @param bool $is_primary True, if the link is primary
     * @param bool $is_revoked True, if the link is revoked
     * @param string|null $name Invite link name
     * @param int|null $expire_date Point in time (Unix timestamp) when the link will expire or has been expired
     * @param int|null $member_limit Maximum number of users that can be members of the chat simultaneously after
     *     joining the chat via this invite link; 1-99999
     * @param int|null $pending_join_request_count Number of pending join requests created using this link
     * @param int|null $subscription_period The number of seconds the subscription will be active for before the next
     *     payment
     * @param int|null $subscription_price The amount of Telegram Stars a user must pay initially and after each
     *     subsequent subscription period to be a member of the chat using the link
     */
    public function __construct(
        public string $invite_link,
        public User $creator,
        public bool $creates_join_request,
        public bool $is_primary,
        public bool $is_revoked,
        public ?string $name = null,
        public ?int $expire_date = null,
        public ?int $member_limit = null,
        public ?int $pending_join_request_count = null,
        public ?int $subscription_period = null,
        public ?int $subscription_price = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            invite_link: $data['invite_link'],
            creator: User::makeByArray($data['creator']),
            creates_join_request: $data['creates_join_request'],
            is_primary: $data['is_primary'],
            is_revoked: $data['is_revoked'],
            name: $data['name'] ?? null,
            expire_date: $data['expire_date'] ?? null,
            member_limit: $data['member_limit'] ?? null,
            pending_join_request_count: $data['pending_join_request_count'] ?? null,
            subscription_period: $data['subscription_period'] ?? null,
            subscription_price: $data['subscription_price'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'invite_link' => $this->invite_link,
            'creator' => $this->creator,
            'creates_join_request' => $this->creates_join_request,
            'is_primary' => $this->is_primary,
            'is_revoked' => $this->is_revoked,
            'name' => $this->name,
            'expire_date' => $this->expire_date,
            'member_limit' => $this->member_limit,
            'pending_join_request_count' => $this->pending_join_request_count,
            'subscription_period' => $this->subscription_period,
            'subscription_price' => $this->subscription_price,
        ];
    }
}
