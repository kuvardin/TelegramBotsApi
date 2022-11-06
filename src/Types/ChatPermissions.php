<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes actions that a non-administrator user is allowed to take in a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatPermissions extends Type
{
    /**
     * @param bool|null $can_send_messages <em>True</em>, if the user is allowed to send text messages, contacts,
     *     locations and venues
     * @param bool|null $can_send_media_messages <em>True</em>, if the user is allowed to send audios, documents,
     *     photos, videos, video notes and voice notes, implies can_send_messages
     * @param bool|null $can_send_polls <em>True</em>, if the user is allowed to send polls, implies can_send_messages
     * @param bool|null $can_send_other_messages <em>True</em>, if the user is allowed to send animations, games,
     *     stickers and use inline bots, implies can_send_media_messages
     * @param bool|null $can_add_web_page_previews <em>True</em>, if the user is allowed to add web page previews to
     *     their messages, implies can_send_media_messages
     * @param bool|null $can_change_info <em>True</em>, if the user is allowed to change the chat title, photo and
     *     other settings. Ignored in public supergroups
     * @param bool|null $can_invite_users <em>True</em>, if the user is allowed to invite new users to the chat
     * @param bool|null $can_pin_messages <em>True</em>, if the user is allowed to pin messages. Ignored in public
     *     supergroups
     * @param bool|null $can_manage_topics True, if the user is allowed to create forum topics. If omitted defaults
     *     to the value of can_pin_messages
     */
    public function __construct(
        public ?bool $can_send_messages = null,
        public ?bool $can_send_media_messages = null,
        public ?bool $can_send_polls = null,
        public ?bool $can_send_other_messages = null,
        public ?bool $can_add_web_page_previews = null,
        public ?bool $can_change_info = null,
        public ?bool $can_invite_users = null,
        public ?bool $can_pin_messages = null,
        public ?bool $can_manage_topics = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            can_send_messages: $data['can_send_messages'] ?? null,
            can_send_media_messages: $data['can_send_media_messages'] ?? null,
            can_send_polls: $data['can_send_polls'] ?? null,
            can_send_other_messages: $data['can_send_other_messages'] ?? null,
            can_add_web_page_previews: $data['can_add_web_page_previews'] ?? null,
            can_change_info: $data['can_change_info'] ?? null,
            can_invite_users: $data['can_invite_users'] ?? null,
            can_pin_messages: $data['can_pin_messages'] ?? null,
            can_manage_topics: $data['can_manage_topics'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'can_send_messages' => $this->can_send_messages,
            'can_send_media_messages' => $this->can_send_media_messages,
            'can_send_polls' => $this->can_send_polls,
            'can_send_other_messages' => $this->can_send_other_messages,
            'can_add_web_page_previews' => $this->can_add_web_page_previews,
            'can_change_info' => $this->can_change_info,
            'can_invite_users' => $this->can_invite_users,
            'can_pin_messages' => $this->can_pin_messages,
            'can_manage_topics' => $this->can_manage_topics,
        ];
    }
}
