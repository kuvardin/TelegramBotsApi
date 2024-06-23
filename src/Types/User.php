<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use Kuvardin\TelegramBotsApi\Username;

/**
 * This object represents a Telegram user or bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class User extends Type
{
    /**
     * @param int $id Unique identifier for this user or bot. This number may have more than 32 significant bits and
     *     some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52
     *     significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     * @param bool $is_bot True, if this user is a bot
     * @param string $first_name User's or bot's first name
     * @param string|null $last_name User's or bot's last name
     * @param Username|null $username User's or bot's username
     * @param string|null $language_code IETF language tag of the user's language
     * @param bool|null $is_premium True, if this user is a Telegram Premium user
     * @param bool|null $added_to_attachment_menu True, if this user added the bot to the attachment menu
     * @param bool|null $can_join_groups True, if the bot can be invited to groups. Returned only in getMe().
     * @param bool|null $can_read_all_group_messages True, if privacy mode is disabled for the bot.
     *     Returned only in getMe().
     * @param bool|null $supports_inline_queries True, if the bot supports inline queries.
     *     Returned only in getMe().
     * @param bool|null $can_connect_to_business True, if the bot can be connected to a Telegram Business account
     *     to receive its messages. Returned only in getMe().
     */
    public function __construct(
        public int $id,
        public bool $is_bot,
        public string $first_name,
        public ?string $last_name = null,
        public ?Username $username = null,
        public ?string $language_code = null,
        public ?bool $is_premium = null,
        public ?bool $added_to_attachment_menu = null,
        public ?bool $can_join_groups = null,
        public ?bool $can_read_all_group_messages = null,
        public ?bool $supports_inline_queries = null,
        public ?bool $can_connect_to_business = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            is_bot: $data['is_bot'],
            first_name: $data['first_name'],
            last_name: $data['last_name'] ?? null,
            username: isset($data['username'])
                ? new Username($data['username'])
                : null,
            language_code: $data['language_code'] ?? null,
            is_premium: $data['is_premium'] ?? null,
            added_to_attachment_menu: $data['added_to_attachment_menu'] ?? null,
            can_join_groups: $data['can_join_groups'] ?? null,
            can_read_all_group_messages: $data['can_read_all_group_messages'] ?? null,
            supports_inline_queries: $data['supports_inline_queries'] ?? null,
            can_connect_to_business: $data['can_connect_to_business'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'is_bot' => $this->is_bot,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username?->getShort(),
            'language_code' => $this->language_code,
            'is_premium' => $this->is_premium,
            'added_to_attachment_menu' => $this->added_to_attachment_menu,
            'can_join_groups' => $this->can_join_groups,
            'can_read_all_group_messages' => $this->can_read_all_group_messages,
            'supports_inline_queries' => $this->supports_inline_queries,
            'can_connect_to_business' => $this->can_connect_to_business,
        ];
    }
}
