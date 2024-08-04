<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\ChatType;
use Kuvardin\TelegramBotsApi\Type;
use Kuvardin\TelegramBotsApi\Username;

/**
 * This object contains full information about a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatFullInfo extends Type
{
    /**
     * @param int $id Unique identifier for this chat. This number may have more than 32 significant bits and some
     *     programming languages may have difficulty/silent defects in interpreting it. But it has at most
     *     52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this
     *     identifier.
     * @param string $type_value Type of the chat, can be one of Enums\ChatType::*
     * @param int $accent_color_id Identifier of the accent color for the chat name and backgrounds of the chat photo,
     *     reply header, and link preview. See accent colors for more details.
     * @param int $max_reaction_count The maximum number of reactions that can be set on a message in the chat
     * @param string|null $title Title, for supergroups, channels and group chats
     * @param Username|null $username Username, for private chats, supergroups and channels if available
     * @param string|null $first_name First name of the other party in a private chat
     * @param string|null $last_name Last name of the other party in a private chat
     * @param bool|null $is_forum True, if the supergroup chat is a forum (has topics enabled)
     * @param ChatPhoto|null $photo Chat photo
     * @param string[]|null $active_usernames If non-empty, the list of all active chat usernames; for private chats,
     *     supergroups and channels
     * @param Birthdate|null $birthdate For private chats, the date of birth of the user
     * @param BusinessIntro|null $business_intro For private chats with business accounts, the intro of the business
     * @param BusinessLocation|null $business_location For private chats with business accounts, the location of the
     *     business
     * @param BusinessOpeningHours|null $business_opening_hours For private chats with business accounts, the opening
     *     hours of the business
     * @param Chat|null $personal_chat For private chats, the personal channel of the user
     * @param ReactionType[]|null $available_reactions List of available reactions allowed in the chat. If omitted,
     *     then all emoji reactions are allowed.
     * @param string|null $background_custom_emoji_id Custom emoji identifier of the emoji chosen by the chat for
     *     the reply header and link preview background
     * @param int|null $profile_accent_color_id Identifier of the accent color for the chat's profile background.
     *     See profile accent colors for more details.
     * @param string|null $profile_background_custom_emoji_id Custom emoji identifier of the emoji chosen by the chat
     *     for its profile background
     * @param string|null $emoji_status_custom_emoji_id Custom emoji identifier of the emoji status of the chat or
     *     the other party in a private chat
     * @param int|null $emoji_status_expiration_date Expiration date of the emoji status of the chat or the other party
     *     in a private chat, in Unix time, if any
     * @param string|null $bio Bio of the other party in a private chat
     * @param bool|null $has_private_forwards True, if privacy settings of the other party in the private chat allows
     *     to use "tg://user?id=%user_id%" links only in chats with the user
     * @param bool|null $has_restricted_voice_and_video_messages True, if the privacy settings of the other party
     *     restrict sending voice and video note messages in the private chat
     * @param bool|null $join_to_send_messages True, if users need to join the supergroup before they can send messages
     * @param bool|null $join_by_request True, if all users directly joining the supergroup without using an invite link
     *     need to be approved by supergroup administrators
     * @param string|null $description Description, for groups, supergroups and channel chats
     * @param string|null $invite_link Primary invite link, for groups, supergroups and channel chats
     * @param Message|null $pinned_message The most recent pinned message (by sending date)
     * @param ChatPermissions|null $permissions Default chat member permissions, for groups and supergroups
     * @param int|null $slow_mode_delay For supergroups, the minimum allowed delay between consecutive messages sent
     *     by each unprivileged user; in seconds
     * @param int|null $unrestrict_boost_count For supergroups, the minimum number of boosts that a non-administrator
     *     user needs to add in order to ignore slow mode and chat permissions
     * @param int|null $message_auto_delete_time The time after which all messages sent to the chat will be
     *     automatically deleted; in seconds
     * @param bool|null $has_aggressive_anti_spam_enabled True, if aggressive anti-spam checks are enabled in
     *     the supergroup. The field is only available to chat administrators.
     * @param bool|null $has_hidden_members True, if non-administrators can only get the list of bots and administrators
     *     in the chat
     * @param bool|null $has_protected_content True, if messages from the chat can't be forwarded to other chats
     * @param bool|null $has_visible_history True, if new chat members will have access to old messages; available only
     *     to chat administrators
     * @param string|null $sticker_set_name For supergroups, name of the group sticker set
     * @param bool|null $can_set_sticker_set True, if the bot can change the group sticker set
     * @param string|null $custom_emoji_sticker_set_name For supergroups, the name of the group's custom emoji sticker
     *     set. Custom emoji from this set can be used by all users and bots in the group.
     * @param int|null $linked_chat_id Unique identifier for the linked chat, i.e. the discussion group identifier
     *     for a channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits
     *     and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than
     *     52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     * @param ChatLocation|null $location For supergroups, the location to which the supergroup is connected
     */
    public function __construct(
        public int $id,
        public string $type_value,
        public int $accent_color_id,
        public int $max_reaction_count,
        public ?string $title = null,
        public ?Username $username = null,
        public ?string $first_name = null,
        public ?string $last_name = null,
        public ?bool $is_forum = null,
        public ?ChatPhoto $photo = null,
        public ?array $active_usernames = null,
        public ?Birthdate $birthdate = null,
        public ?BusinessIntro $business_intro = null,
        public ?BusinessLocation $business_location = null,
        public ?BusinessOpeningHours $business_opening_hours = null,
        public ?Chat $personal_chat = null,
        public ?array $available_reactions = null,
        public ?string $background_custom_emoji_id = null,
        public ?int $profile_accent_color_id = null,
        public ?string $profile_background_custom_emoji_id = null,
        public ?string $emoji_status_custom_emoji_id = null,
        public ?int $emoji_status_expiration_date = null,
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
        public ?int $unrestrict_boost_count = null,
        public ?int $message_auto_delete_time = null,
        public ?bool $has_aggressive_anti_spam_enabled = null,
        public ?bool $has_hidden_members = null,
        public ?bool $has_protected_content = null,
        public ?bool $has_visible_history = null,
        public ?string $sticker_set_name = null,
        public ?bool $can_set_sticker_set = null,
        public ?string $custom_emoji_sticker_set_name = null,
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
            accent_color_id: $data['accent_color_id'],
            max_reaction_count: $data['max_reaction_count'],
            title: $data['title'] ?? null,
            username: empty($data['username']) ? null : new Username($data['username']),
            first_name: $data['first_name'] ?? null,
            last_name: $data['last_name'] ?? null,
            is_forum: $data['is_forum'] ?? null,
            photo: isset($data['photo'])
                ? ChatPhoto::makeByArray($data['photo'])
                : null,
            active_usernames: $data['active_usernames'] ?? null,
            birthdate: isset($data['birthdate'])
                ? Birthdate::makeByArray($data['birthdate'])
                : null,
            business_intro: isset($data['business_intro'])
                ? BusinessIntro::makeByArray($data['business_intro'])
                : null,
            business_location: isset($data['business_location'])
                ? BusinessLocation::makeByArray($data['business_location'])
                : null,
            business_opening_hours: isset($data['business_opening_hours'])
                ? BusinessOpeningHours::makeByArray($data['business_opening_hours'])
                : null,
            personal_chat: isset($data['personal_chat'])
                ? Chat::makeByArray($data['personal_chat'])
                : null,
            available_reactions: isset($data['available_reactions'])
                ? array_map(
                    static fn(array $available_reactions_data) => ReactionType::makeByArray($available_reactions_data),
                    $data['available_reactions'],
                )
                : null,
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
            has_aggressive_anti_spam_enabled: $data['has_aggressive_anti_spam_enabled'] ?? null,
            has_hidden_members: $data['has_hidden_members'] ?? null,
            has_protected_content: $data['has_protected_content'] ?? null,
            has_visible_history: $data['has_visible_history'] ?? null,
            sticker_set_name: $data['sticker_set_name'] ?? null,
            can_set_sticker_set: $data['can_set_sticker_set'] ?? null,
            custom_emoji_sticker_set_name: $data['custom_emoji_sticker_set_name'] ?? null,
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
            'accent_color_id' => $this->accent_color_id,
            'max_reaction_count' => $this->max_reaction_count,
            'photo' => $this->photo,
            'active_usernames' => $this->active_usernames,
            'birthdate' => $this->birthdate,
            'business_intro' => $this->business_intro,
            'business_location' => $this->business_location,
            'business_opening_hours' => $this->business_opening_hours,
            'personal_chat' => $this->personal_chat,
            'available_reactions' => $this->available_reactions,
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
