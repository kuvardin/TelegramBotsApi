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
     * @var string $invite_link The invite link. If the link was created by another chat administrator, then the second
     *     part of the link will be replaced with “…”.
     */
    public string $invite_link;

    /**
     * @var User $creator Creator of the link
     */
    public User $creator;

    /**
     * @var bool $creates_join_request <em>True</em>, if users joining the chat via the link need to be approved by
     *     chat administrators
     */
    public bool $creates_join_request;

    /**
     * @var bool $is_primary <em>True</em>, if the link is primary
     */
    public bool $is_primary;

    /**
     * @var bool $is_revoked <em>True</em>, if the link is revoked
     */
    public bool $is_revoked;

    /**
     * @var string|null $name Invite link name
     */
    public ?string $name = null;

    /**
     * @var int|null $expire_date Point in time (Unix timestamp) when the link will expire or has been expired
     */
    public ?int $expire_date = null;

    /**
     * @var int|null $member_limit Maximum number of users that can be members of the chat simultaneously after joining
     *     the chat via this invite link; 1-99999
     */
    public ?int $member_limit = null;

    /**
     * @var int|null $pending_join_request_count Number of pending join requests created using this link
     */
    public ?int $pending_join_request_count = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->invite_link = $data['invite_link'];
        $result->creator = User::makeByArray($data['creator']);
        $result->creates_join_request = $data['creates_join_request'];
        $result->is_primary = $data['is_primary'];
        $result->is_revoked = $data['is_revoked'];
        $result->name = $data['name'] ?? null;
        $result->expire_date = $data['expire_date'] ?? null;
        $result->member_limit = $data['member_limit'] ?? null;
        $result->pending_join_request_count = $data['pending_join_request_count'] ?? null;
        return $result;
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
        ];
    }
}
