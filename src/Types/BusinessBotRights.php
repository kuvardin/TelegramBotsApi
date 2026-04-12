<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Represents the rights of a business bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BusinessBotRights extends Type
{
    /**
     * @param bool|null $can_reply True, if the bot can send and edit messages in the private chats that had incoming
     *     messages in the last 24 hours
     * @param bool|null $can_read_messages True, if the bot can mark incoming private messages as read
     * @param bool|null $can_delete_sent_messages True, if the bot can delete messages sent by the bot
     * @param bool|null $can_delete_all_messages True, if the bot can delete all private messages in managed chats
     * @param bool|null $can_edit_name True, if the bot can edit the first and last name of the business account
     * @param bool|null $can_edit_bio True, if the bot can edit the bio of the business account
     * @param bool|null $can_edit_profile_photo True, if the bot can edit the profile photo of the business account
     * @param bool|null $can_edit_username True, if the bot can edit the username of the business account
     * @param bool|null $can_change_gift_settings True, if the bot can change the privacy settings pertaining to gifts
     *     for the business account
     * @param bool|null $can_view_gifts_and_stars True, if the bot can view gifts and the amount of Telegram Stars owned
     *     by the business account
     * @param bool|null $can_convert_gifts_to_stars True, if the bot can convert regular gifts owned by the business
     *     account to Telegram Stars
     * @param bool|null $can_transfer_and_upgrade_gifts True, if the bot can transfer and upgrade gifts owned by
     *     the business account
     * @param bool|null $can_transfer_stars True, if the bot can transfer Telegram Stars received by the business
     *     account to its own account, or use them to upgrade and transfer gifts
     * @param bool|null $can_manage_stories True, if the bot can post, edit and delete stories on behalf of
     *     the business account
     */
    public function __construct(
        public ?bool $can_reply = null,
        public ?bool $can_read_messages = null,
        public ?bool $can_delete_sent_messages = null,
        public ?bool $can_delete_all_messages = null,
        public ?bool $can_edit_name = null,
        public ?bool $can_edit_bio = null,
        public ?bool $can_edit_profile_photo = null,
        public ?bool $can_edit_username = null,
        public ?bool $can_change_gift_settings = null,
        public ?bool $can_view_gifts_and_stars = null,
        public ?bool $can_convert_gifts_to_stars = null,
        public ?bool $can_transfer_and_upgrade_gifts = null,
        public ?bool $can_transfer_stars = null,
        public ?bool $can_manage_stories = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            can_reply: $data['can_reply'] ?? null,
            can_read_messages: $data['can_read_messages'] ?? null,
            can_delete_sent_messages: $data['can_delete_sent_messages'] ?? null,
            can_delete_all_messages: $data['can_delete_all_messages'] ?? null,
            can_edit_name: $data['can_edit_name'] ?? null,
            can_edit_bio: $data['can_edit_bio'] ?? null,
            can_edit_profile_photo: $data['can_edit_profile_photo'] ?? null,
            can_edit_username: $data['can_edit_username'] ?? null,
            can_change_gift_settings: $data['can_change_gift_settings'] ?? null,
            can_view_gifts_and_stars: $data['can_view_gifts_and_stars'] ?? null,
            can_convert_gifts_to_stars: $data['can_convert_gifts_to_stars'] ?? null,
            can_transfer_and_upgrade_gifts: $data['can_transfer_and_upgrade_gifts'] ?? null,
            can_transfer_stars: $data['can_transfer_stars'] ?? null,
            can_manage_stories: $data['can_manage_stories'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'can_reply' => $this->can_reply,
            'can_read_messages' => $this->can_read_messages,
            'can_delete_sent_messages' => $this->can_delete_sent_messages,
            'can_delete_all_messages' => $this->can_delete_all_messages,
            'can_edit_name' => $this->can_edit_name,
            'can_edit_bio' => $this->can_edit_bio,
            'can_edit_profile_photo' => $this->can_edit_profile_photo,
            'can_edit_username' => $this->can_edit_username,
            'can_change_gift_settings' => $this->can_change_gift_settings,
            'can_view_gifts_and_stars' => $this->can_view_gifts_and_stars,
            'can_convert_gifts_to_stars' => $this->can_convert_gifts_to_stars,
            'can_transfer_and_upgrade_gifts' => $this->can_transfer_and_upgrade_gifts,
            'can_transfer_stars' => $this->can_transfer_stars,
            'can_manage_stories' => $this->can_manage_stories,
        ];
    }
}
