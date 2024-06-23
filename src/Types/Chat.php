<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use JetBrains\PhpStorm\Deprecated;
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
     */
    public function __construct(
        public int $id,
        public string $type_value,
        public ?string $title = null,
        public ?Username $username = null,
        public ?string $first_name = null,
        public ?string $last_name = null,
        public ?bool $is_forum = null,

        #[Deprecated] public ?ChatPhoto $photo = null,
        #[Deprecated] public ?array $active_usernames = null,
        #[Deprecated] public ?array $available_reactions = null,
        #[Deprecated] public ?int $accent_color_id = null,
        #[Deprecated] public ?string $background_custom_emoji_id = null,
        #[Deprecated] public ?int $profile_accent_color_id = null,
        #[Deprecated] public ?string $profile_background_custom_emoji_id = null,
        #[Deprecated] public ?string $emoji_status_custom_emoji_id = null,
        #[Deprecated] public ?int $emoji_status_expiration_date = null,
        #[Deprecated] public ?string $bio = null,
        #[Deprecated] public ?bool $has_private_forwards = null,
        #[Deprecated] public ?bool $has_restricted_voice_and_video_messages = null,
        #[Deprecated] public ?bool $join_to_send_messages = null,
        #[Deprecated] public ?bool $join_by_request = null,
        #[Deprecated] public ?string $description = null,
        #[Deprecated] public ?string $invite_link = null,
        #[Deprecated] public ?Message $pinned_message = null,
        #[Deprecated] public ?ChatPermissions $permissions = null,
        #[Deprecated] public ?int $slow_mode_delay = null,
        #[Deprecated] public ?int $unrestrict_boost_count = null,
        #[Deprecated] public ?int $message_auto_delete_time = null,
        #[Deprecated] public ?bool $has_protected_content = null,
        #[Deprecated] public ?bool $has_visible_history = null,
        #[Deprecated] public ?string $sticker_set_name = null,
        #[Deprecated] public ?bool $can_set_sticker_set = null,
        #[Deprecated] public ?string $custom_emoji_sticker_set_name = null,
        #[Deprecated] public ?int $linked_chat_id = null,
        #[Deprecated] public ?ChatLocation $location = null,
        #[Deprecated] public ?bool $has_hidden_members = null,
        #[Deprecated] public ?bool $has_aggressive_anti_spam_enabled = null,
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
            available_reactions: isset($data['available_reactions'])
                ? array_map(
                    static fn($item_data) => ReactionType::makeByArray($item_data),
                    $data['available_reactions'],
                )
                : null,
            accent_color_id: $data['accent_color_id'] ?? null,
            background_custom_emoji_id: $data['background_custom_emoji_id'] ?? null,
            profile_accent_color_id: $data['profile_accent_color_id'] ?? null,
            profile_background_custom_emoji_id: $data['profile_background_custom_emoji_id'] ?? null,
            emoji_status_custom_emoji_id: $data['emoji_status_custom_emoji_id'] ?? null,
            emoji_status_expiration_date: $data['emoji_status_expiration_date'] ?? null,
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
            unrestrict_boost_count: $data['unrestrict_boost_count'] ?? null,
            message_auto_delete_time: $data['message_auto_delete_time'] ?? null,
            has_protected_content: $data['has_protected_content'] ?? null,
            has_visible_history: $data['has_visible_history'] ?? null,
            sticker_set_name: $data['sticker_set_name'] ?? null,
            can_set_sticker_set: $data['can_set_sticker_set'] ?? null,
            custom_emoji_sticker_set_name: $data['custom_emoji_sticker_set_name'] ?? null,
            linked_chat_id: $data['linked_chat_id'] ?? null,
            location: isset($data['location'])
                ? ChatLocation::makeByArray($data['location'])
                : null,
            has_hidden_members: $data['has_hidden_members'] ?? null,
            has_aggressive_anti_spam_enabled: $data['has_aggressive_anti_spam_enabled'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type_value,
            'title' => $this->title,
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'is_forum' => $this->is_forum,

            'photo' => $this->photo,
            'active_usernames' => $this->active_usernames,
            'available_reactions' => $this->available_reactions,
            'accent_color_id' => $this->accent_color_id,
            'background_custom_emoji_id' => $this->background_custom_emoji_id,
            'profile_accent_color_id' => $this->profile_accent_color_id,
            'profile_background_custom_emoji_id' => $this->profile_background_custom_emoji_id,
            'emoji_status_custom_emoji_id' => $this->emoji_status_custom_emoji_id,
            'emoji_status_expiration_date' => $this->emoji_status_expiration_date,
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
            'unrestrict_boost_count' => $this->unrestrict_boost_count,
            'message_auto_delete_time' => $this->message_auto_delete_time,
            'has_aggressive_anti_spam_enabled' => $this->has_aggressive_anti_spam_enabled,
            'has_hidden_members' => $this->has_hidden_members,
            'has_protected_content' => $this->has_protected_content,
            'has_visible_history' => $this->has_visible_history,
            'sticker_set_name' => $this->sticker_set_name,
            'can_set_sticker_set' => $this->can_set_sticker_set,
            'custom_emoji_sticker_set_name' => $this->custom_emoji_sticker_set_name,
            'linked_chat_id' => $this->linked_chat_id,
            'location' => $this->location,
        ];
    }

    /**
     * @return ChatType|null Returns Null if the chat type is unknown.
     */
    public function getType(): ?ChatType
    {
        return ChatType::tryFrom($this->type_value);
    }
}
