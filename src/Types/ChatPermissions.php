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
     * @param bool|null $can_send_messages True, if the user is allowed to send text messages, contacts,
     *     invoices, locations and venues
     * @param bool|null $can_send_audios True, if the user is allowed to send audios
     * @param bool|null $can_send_documents True, if the user is allowed to send documents
     * @param bool|null $can_send_photos True, if the user is allowed to send photos
     * @param bool|null $can_send_videos True, if the user is allowed to send videos
     * @param bool|null $can_send_video_notes True, if the user is allowed to send video notes
     * @param bool|null $can_send_voice_notes True, if the user is allowed to send voice notes
     * @param bool|null $can_send_polls True, if the user is allowed to send polls
     * @param bool|null $can_send_other_messages True, if the user is allowed to send animations, games,
     *     stickers and use inline bots
     * @param bool|null $can_add_web_page_previews True, if the user is allowed to add web page previews
     *     to their messages
     * @param bool|null $can_change_info True, if the user is allowed to change the chat title, photo and
     *     other settings. Ignored in public supergroups
     * @param bool|null $can_invite_users True, if the user is allowed to invite new users to the chat
     * @param bool|null $can_pin_messages True, if the user is allowed to pin messages. Ignored in public
     *     supergroups
     * @param bool|null $can_manage_topics True, if the user is allowed to create forum topics. If omitted
     *     defaults to the value of can_pin_messages
     */
    public function __construct(
        public ?bool $can_send_messages = null,
        public ?bool $can_send_audios = null,
        public ?bool $can_send_documents = null,
        public ?bool $can_send_photos = null,
        public ?bool $can_send_videos = null,
        public ?bool $can_send_video_notes = null,
        public ?bool $can_send_voice_notes = null,
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
            can_send_audios: $data['can_send_audios'] ?? null,
            can_send_documents: $data['can_send_documents'] ?? null,
            can_send_photos: $data['can_send_photos'] ?? null,
            can_send_videos: $data['can_send_videos'] ?? null,
            can_send_video_notes: $data['can_send_video_notes'] ?? null,
            can_send_voice_notes: $data['can_send_voice_notes'] ?? null,
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
            'can_send_audios' => $this->can_send_audios,
            'can_send_documents' => $this->can_send_documents,
            'can_send_photos' => $this->can_send_photos,
            'can_send_videos' => $this->can_send_videos,
            'can_send_video_notes' => $this->can_send_video_notes,
            'can_send_voice_notes' => $this->can_send_voice_notes,
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
