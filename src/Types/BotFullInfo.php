<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use Kuvardin\TelegramBotsApi\Username;

/**
 * This object contains full information about the bot itself.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BotFullInfo extends Type
{
    /**
     * @param int $id Unique identifier for this bot. This number may have more than 32 significant bits and some
     *     programming languages may have difficulty/silent defects in interpreting it. But it has at most 52
     *     significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     * @param bool $is_bot Always True
     * @param string $first_name Bot's first name
     * @param bool $can_join_groups True, if the bot can be added to groups
     * @param bool $can_read_all_group_messages True, if privacy mode is disabled for the bot
     * @param bool $supports_guest_queries True, if the bot supports guest queries from chats it is not a member of
     * @param bool $supports_inline_queries True, if the bot supports inline queries
     * @param bool $needs_inline_query_location True, if the bot requests the location of the user with every inline
     *     query
     * @param bool $can_connect_to_business True, if the bot can be connected to a user account to manage it
     * @param bool $has_main_web_app True, if the bot has a main Web App
     * @param bool $has_topics_enabled True, if the bot has forum topic mode enabled in private chats
     * @param bool $allows_users_to_create_topics True, if the bot allows users to create and delete topics in private
     *     chats
     * @param bool $has_topic_sidebar True, if topics in private chats with the bot are shown in a sidebar
     * @param bool $can_manage_bots True, if other bots can be created to be controlled by the bot
     * @param bool $supports_join_request_queries True, if the bot supports join request queries and can be assigned to
     *     process them
     * @param Username|null $username Bot's username
     * @param string[]|null $active_usernames If non-empty, the list of all active usernames of the bot
     * @param string|null $inline_query_placeholder Placeholder for inline queries, which is shown in the input field
     *     after the bot's username; omitted if the default placeholder is used
     */
    public function __construct(
        public int $id,
        public bool $is_bot,
        public string $first_name,
        public bool $can_join_groups,
        public bool $can_read_all_group_messages,
        public bool $supports_guest_queries,
        public bool $supports_inline_queries,
        public bool $needs_inline_query_location,
        public bool $can_connect_to_business,
        public bool $has_main_web_app,
        public bool $has_topics_enabled,
        public bool $allows_users_to_create_topics,
        public bool $has_topic_sidebar,
        public bool $can_manage_bots,
        public bool $supports_join_request_queries,
        public ?Username $username = null,
        public ?array $active_usernames = null,
        public ?string $inline_query_placeholder = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            is_bot: $data['is_bot'],
            first_name: $data['first_name'],
            can_join_groups: $data['can_join_groups'],
            can_read_all_group_messages: $data['can_read_all_group_messages'],
            supports_guest_queries: $data['supports_guest_queries'],
            supports_inline_queries: $data['supports_inline_queries'],
            needs_inline_query_location: $data['needs_inline_query_location'],
            can_connect_to_business: $data['can_connect_to_business'],
            has_main_web_app: $data['has_main_web_app'],
            has_topics_enabled: $data['has_topics_enabled'],
            allows_users_to_create_topics: $data['allows_users_to_create_topics'],
            has_topic_sidebar: $data['has_topic_sidebar'],
            can_manage_bots: $data['can_manage_bots'],
            supports_join_request_queries: $data['supports_join_request_queries'],
            username: empty($data['username'])
                ? null
                : new Username($data['username']),
            active_usernames: $data['active_usernames'] ?? null,
            inline_query_placeholder: $data['inline_query_placeholder'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'is_bot' => $this->is_bot,
            'first_name' => $this->first_name,
            'can_join_groups' => $this->can_join_groups,
            'can_read_all_group_messages' => $this->can_read_all_group_messages,
            'supports_guest_queries' => $this->supports_guest_queries,
            'supports_inline_queries' => $this->supports_inline_queries,
            'needs_inline_query_location' => $this->needs_inline_query_location,
            'can_connect_to_business' => $this->can_connect_to_business,
            'has_main_web_app' => $this->has_main_web_app,
            'has_topics_enabled' => $this->has_topics_enabled,
            'allows_users_to_create_topics' => $this->allows_users_to_create_topics,
            'has_topic_sidebar' => $this->has_topic_sidebar,
            'can_manage_bots' => $this->can_manage_bots,
            'supports_join_request_queries' => $this->supports_join_request_queries,
            'username' => $this->username?->getShort(),
            'active_usernames' => $this->active_usernames,
            'inline_query_placeholder' => $this->inline_query_placeholder,
        ];
    }
}





