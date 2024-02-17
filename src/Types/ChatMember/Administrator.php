<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ChatMember;

use Kuvardin\TelegramBotsApi\Types\ChatMember;
use Kuvardin\TelegramBotsApi\Types\User;
use RuntimeException;

/**
 * Represents a <a href="https://core.telegram.org/bots/api#chatmember">chat member</a> that has some additional
 * privileges.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Administrator extends ChatMember
{
    /**
     * @param User $user Information about the user
     * @param bool $can_be_edited <em>True</em>, if the bot is allowed to edit administrator privileges of that user
     * @param bool $is_anonymous <em>True</em>, if the user's presence in the chat is hidden
     * @param bool $can_manage_chat <em>True</em>, if the administrator can access the chat event log, get boost list,
     *     see hidden supergroup and channel members, report spam messages and ignore slow mode. Implied by any other
     *     administrator privilege.
     * @param bool $can_delete_messages <em>True</em>, if the administrator can delete messages of other users
     * @param bool $can_manage_video_chats <em>True</em>, if the administrator can manage video chats
     * @param bool $can_restrict_members <em>True</em>, if the administrator can restrict, ban or unban chat members,
     *     or access supergroup statistics
     * @param bool $can_promote_members <em>True</em>, if the administrator can add new administrators with a subset of
     *     their own privileges or demote administrators that they have promoted, directly or indirectly (promoted by
     *     administrators that were appointed by the user)
     * @param bool $can_change_info <em>True</em>, if the user is allowed to change the chat title, photo and other
     *     settings
     * @param bool $can_invite_users <em>True</em>, if the user is allowed to invite new users to the chat
     * @param bool $can_post_stories <em>True</em>, if the administrator can post stories to the chat
     * @param bool $can_edit_stories <em>True</em>, if the administrator can edit stories posted by other users
     * @param bool $can_delete_stories <em>True</em>, if the administrator can delete stories posted by other users
     * @param bool|null $can_post_messages <em>True</em>, if the administrator can post messages in the channel,
     *     or access channel statistics; channels only
     * @param bool|null $can_edit_messages <em>True</em>, if the administrator can edit messages of other users and
     *     can pin messages; channels only
     * @param bool|null $can_pin_messages <em>True</em>, if the user is allowed to pin messages; groups and supergroups
     *     only
     * @param bool|null $can_manage_topics <em>True</em>, if the user is allowed to create, rename, close, and reopen
     *     forum topics; supergroups only
     * @param string|null $custom_title Custom title for this user
     */
    public function __construct(
        public User $user,
        public bool $can_be_edited,
        public bool $is_anonymous,
        public bool $can_manage_chat,
        public bool $can_delete_messages,
        public bool $can_manage_video_chats,
        public bool $can_restrict_members,
        public bool $can_promote_members,
        public bool $can_change_info,
        public bool $can_invite_users,
        public bool $can_post_stories,
        public bool $can_edit_stories,
        public bool $can_delete_stories,
        public ?bool $can_post_messages = null,
        public ?bool $can_edit_messages = null,
        public ?bool $can_pin_messages = null,
        public ?bool $can_manage_topics = null,
        public ?string $custom_title = null,
    )
    {

    }

    public static function getStatus(): string
    {
        return 'administrator';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['status'] !== self::getStatus()) {
            throw new RuntimeException("Wrong chat member status: {$data['status']}");
        }

        return new self(
            user: User::makeByArray($data['user']),
            can_be_edited: $data['can_be_edited'],
            is_anonymous: $data['is_anonymous'],
            can_manage_chat: $data['can_manage_chat'],
            can_delete_messages: $data['can_delete_messages'],
            can_manage_video_chats: $data['can_manage_video_chats'],
            can_restrict_members: $data['can_restrict_members'],
            can_promote_members: $data['can_promote_members'],
            can_change_info: $data['can_change_info'],
            can_invite_users: $data['can_invite_users'],
            can_post_stories: $data['can_post_stories'],
            can_edit_stories: $data['can_edit_stories'],
            can_delete_stories: $data['can_delete_stories'],
            can_post_messages: $data['can_post_messages'] ?? null,
            can_edit_messages: $data['can_edit_messages'] ?? null,
            can_pin_messages: $data['can_pin_messages'] ?? null,
            can_manage_topics: $data['can_manage_topics'] ?? null,
            custom_title: $data['custom_title'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'status' => self::getStatus(),
            'user' => $this->user,
            'can_be_edited' => $this->can_be_edited,
            'is_anonymous' => $this->is_anonymous,
            'can_manage_chat' => $this->can_manage_chat,
            'can_delete_messages' => $this->can_delete_messages,
            'can_manage_video_chats' => $this->can_manage_video_chats,
            'can_restrict_members' => $this->can_restrict_members,
            'can_promote_members' => $this->can_promote_members,
            'can_change_info' => $this->can_change_info,
            'can_invite_users' => $this->can_invite_users,
            'can_post_stories' => $this->can_post_stories,
            'can_edit_stories' => $this->can_edit_stories,
            'can_delete_stories' => $this->can_delete_stories,
            'can_post_messages' => $this->can_post_messages,
            'can_edit_messages' => $this->can_edit_messages,
            'can_pin_messages' => $this->can_pin_messages,
            'can_manage_topics' => $this->can_manage_topics,
            'custom_title' => $this->custom_title,
        ];
    }
}
