<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\ChatType;
use Kuvardin\TelegramBotsApi\Type;
use Kuvardin\TelegramBotsApi\Username;

/**
 * This object represents a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Chat extends Type
{
    /**
     * @param int $id Unique identifier for this chat. This number may have more than 32 significant bits and some
     *     programming languages may have difficulty/silent defects in interpreting it. But it has at most 52
     *     significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this
     *     identifier.
     * @param string $type_value Name of type of chat, can be Enums\ChatType::*
     * @param string|null $title Title, for supergroups, channels and group chats
     * @param Username|null $username Username, for private chats, supergroups and channels if available
     * @param string|null $first_name First name of the other party in a private chat
     * @param string|null $last_name Last name of the other party in a private chat
     * @param bool|null $is_forum True, if the supergroup chat is a forum (has topics enabled)
     * @param ChatPhoto|null $photo Chat photo. Returned only in getChat().
     * @param string[]|null $active_usernames Optional. If non-empty, the list of all active chat usernames;
     *     for private chats, supergroups and channels. Returned only in getChat().
     * @param string|null $emoji_status_custom_emoji_id Custom emoji identifier of emoji status of the other party in
     *     a private chat. Returned only in getChat().
     * @param string|null $bio Bio of the other party in a private chat. Returned only in getChat().
     * @param bool|null $has_private_forwards True, if privacy settings of the other party in the private chat allows
     *     to use <code>tg://user?id=<user_id></code> links only in chats with the user. Returned only in getChat().
     * @param bool|null $has_restricted_voice_and_video_messages True, if the privacy settings of the other party
     *     restrict sending voice and video note messages in the private chat. Returned only in getChat().
     * @param bool|null $join_to_send_messages True, if users need to join the supergroup before they can send messages.
     *     Returned only in getChat().
     * @param bool|null $join_by_request True, if all users directly joining the supergroup need to be approved by
     *     supergroup administrators. Returned only in getChat().
     * @param string|null $description Description, for groups, supergroups and channel chats. Returned only in
     *     getChat().
     * @param string|null $invite_link Primary invite link, for groups, supergroups and channel chats. Returned only in
     *     getChat().
     * @param Message|null $pinned_message The most recent pinned message (by sending date). Returned only in getChat().
     * @param ChatPermissions|null $permissions Default chat member permissions, for groups and supergroups. Returned
     *     only in getChat().
     * @param int|null $slow_mode_delay For supergroups, the minimum allowed delay between consecutive messages sent by
     *     each unpriviledged user; in seconds. Returned only in getChat().
     * @param int|null $message_auto_delete_time The time after which all messages sent to the chat will be
     *     automatically deleted; in seconds. Returned only in Returned only in getChat().
     * @param bool|null $has_protected_content True, if messages from the chat can't be forwarded to other chats.
     *     Returned only in getChat().
     * @param string|null $sticker_set_name For supergroups, name of group sticker set. Returned only in getChat().
     * @param bool|null $can_set_sticker_set <em>True</em>, if the bot can change the group sticker set. Returned only
     *     in getChat().
     * @param int|null $linked_chat_id Unique identifier for the linked chat, i.e. the discussion group identifier for
     *     a channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits and
     *     some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52
     *     bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     *     Returned only in getChat().
     * @param ChatLocation|null $location For supergroups, the location to which the supergroup is connected. Returned
     *     only in getChat().
     */
    public function __construct(
        public int $id,
        public string $type_value,
        public ?string $title = null,
        public ?Username $username = null,
        public ?string $first_name = null,
        public ?string $last_name = null,
        public ?bool $is_forum = null,
        public ?ChatPhoto $photo = null,
        public ?array $active_usernames = null,
        public ?string $emoji_status_custom_emoji_id = null,
        public ?string $bio = null,
        public ?bool $has_private_forwards = null,
        public ?bool $has_restricted_voice_and_video_messages = null,
        public ?bool $join_to_send_messages = null,
        public ?bool $join_by_request = null,
        public ?string $description = null,
        public ?string $invite_link = null,
        public ?Message $pinned_message = null,
        public ?ChatPermissions $permissions = null,
        public ?int $slow_mode_delay = null,
        public ?int $message_auto_delete_time = null,
        public ?bool $has_protected_content = null,
        public ?string $sticker_set_name = null,
        public ?bool $can_set_sticker_set = null,
        public ?int $linked_chat_id = null,
        public ?ChatLocation $location = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            type_value: $data['type'],
            title: $data['title'] ?? null,
            username: isset($data['username'])
                ? new Username($data['username'])
                : null,
            first_name: $data['first_name'] ?? null,
            last_name: $data['last_name'] ?? null,
            is_forum: $data['is_forum'] ?? null,
            photo: isset($data['photo'])
                ? ChatPhoto::makeByArray($data['photo'])
                : null,
            active_usernames: $data['active_usernames'] ?? null,
            emoji_status_custom_emoji_id: $data['emoji_status_custom_emoji_id'] ?? null,
            bio: $data['bio'] ?? null,
            has_private_forwards: $data['has_private_forwards'] ?? null,
            has_restricted_voice_and_video_messages: $data['has_restricted_voice_and_video_messages'] ?? null,
            join_to_send_messages: $data['join_to_send_messages'] ?? null,
            join_by_request: $data['join_by_request'] ?? null,
            description: $data['description'] ?? null,
            invite_link: $data['invite_link'] ?? null,
            pinned_message: isset($data['pinned_message'])
                ? Message::makeByArray($data['pinned_message'])
                : null,
            permissions: isset($data['permissions'])
                ? ChatPermissions::makeByArray($data['permissions'])
                : null,
            slow_mode_delay: $data['slow_mode_delay'] ?? null,
            message_auto_delete_time: $data['message_auto_delete_time'] ?? null,
            has_protected_content: $data['has_protected_content'] ?? null,
            sticker_set_name: $data['sticker_set_name'] ?? null,
            can_set_sticker_set: $data['can_set_sticker_set'] ?? null,
            linked_chat_id: $data['linked_chat_id'] ?? null,
            location: isset($data['location'])
                ? ChatLocation::makeByArray($data['location'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type_value,
            'title' => $this->title,
            'username' => $this->username?->getShort(),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'is_forum' => $this->is_forum,
            'photo' => $this->photo,
            'bio' => $this->bio,
            'has_private_forwards' => $this->has_private_forwards,
            'has_restricted_voice_and_video_messages' => $this->has_restricted_voice_and_video_messages,
            'join_to_send_messages' => $this->join_to_send_messages,
            'join_by_request' => $this->join_by_request,
            'description' => $this->description,
            'invite_link' => $this->invite_link,
            'pinned_message' => $this->pinned_message,
            'permissions' => $this->permissions,
            'slow_mode_delay' => $this->slow_mode_delay,
            'message_auto_delete_time' => $this->message_auto_delete_time,
            'has_protected_content' => $this->has_protected_content,
            'sticker_set_name' => $this->sticker_set_name,
            'can_set_sticker_set' => $this->can_set_sticker_set,
            'linked_chat_id' => $this->linked_chat_id,
            'location' => $this->location,
        ];
    }

    /**
     * @return ChatType|null Returns <em>Null</em> if the chat type is unknown.
     */
    public function getType(): ?ChatType
    {
        return ChatType::tryFrom($this->type_value);
    }
}
