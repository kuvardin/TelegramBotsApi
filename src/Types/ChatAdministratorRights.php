<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Represents the rights of an administrator in a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatAdministratorRights extends Type
{
    /**
     * @param bool $is_anonymous True, if the user's presence in the chat is hidden
     * @param bool $can_manage_chat True, if the administrator can access the chat event log, get boost list, see
     *     hidden supergroup and channel members, report spam messages, ignore slow mode, and send messages to the chat
     *     without paying Telegram Stars. Implied by any other administrator privilege.
     * @param bool $can_delete_messages True, if the administrator can delete messages of other users
     * @param bool $can_manage_video_chats True, if the administrator can manage video chats
     * @param bool $can_restrict_members True, if the administrator can restrict, ban or unban chat members, or access
     *     supergroup statistics
     * @param bool $can_promote_members True, if the administrator can add new administrators with a subset of their
     *     own privileges or demote administrators that they have promoted, directly or indirectly (promoted by
     *     administrators that were appointed by the user)
     * @param bool $can_change_info True, if the user is allowed to change the chat title, photo and other settings
     * @param bool $can_invite_users True, if the user is allowed to invite new users to the chat
     * @param bool $can_post_stories True, if the administrator can post stories to the chat
     * @param bool $can_edit_stories True, if the administrator can edit stories posted by other users, post stories to
     *     the chat page, pin chat stories, and access the chat's story archive
     * @param bool $can_delete_stories True, if the administrator can delete stories posted by other users
     * @param bool|null $can_post_messages True, if the administrator can post messages in the channel, approve
     *     suggested posts, or access channel statistics; for channels only
     * @param bool|null $can_edit_messages True, if the administrator can edit messages of other users and can pin
     *     messages; for channels only
     * @param bool|null $can_pin_messages True, if the user is allowed to pin messages; for groups and supergroups only
     * @param bool|null $can_manage_topics True, if the user is allowed to create, rename, close, and reopen forum
     *     topics; for supergroups only
     * @param bool|null $can_manage_direct_messages True, if the administrator can manage direct messages of the
     *     channel and decline suggested posts; for channels only
     * @param bool|null $can_manage_tags True, if the administrator can edit the tags of regular members; for groups
     *     and supergroups only. If omitted defaults to the value of can_pin_messages.
     */
    public function __construct(
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
        public ?bool $can_manage_direct_messages = null,
        public ?bool $can_manage_tags = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
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
            can_manage_direct_messages: $data['can_manage_direct_messages'] ?? null,
            can_manage_tags: $data['can_manage_tags'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
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
            'can_manage_direct_messages' => $this->can_manage_direct_messages,
            'can_manage_tags' => $this->can_manage_tags,
        ];
    }
}
