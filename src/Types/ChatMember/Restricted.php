<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ChatMember;

use Kuvardin\TelegramBotsApi\Types\ChatMember;
use Kuvardin\TelegramBotsApi\Types\User;
use RuntimeException;

/**
 * Represents a <a href="https://core.telegram.org/bots/api#chatmember">chat member</a> that is under certain
 * restrictions in the chat. Supergroups only.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Restricted extends ChatMember
{
    /**
     * @param User $user Information about the user
     * @param bool $is_member True, if the user is a member of the chat at the moment of the request
     * @param bool $can_send_messages True, if the user is allowed to send text messages, contacts, invoices,
     *     locations and venues
     * @param bool $can_send_audios True, if the user is allowed to send audios
     * @param bool $can_send_documents True, if the user is allowed to send documents
     * @param bool $can_send_photos True, if the user is allowed to send photos
     * @param bool $can_send_videos True, if the user is allowed to send videos
     * @param bool $can_send_video_notes True, if the user is allowed to send video notes
     * @param bool $can_send_voice_notes True, if the user is allowed to send voice notes
     * @param bool $can_send_polls True, if the user is allowed to send polls
     * @param bool $can_send_other_messages True, if the user is allowed to send animations, games, stickers
     *     and use inline bots
     * @param bool $can_add_web_page_previews True, if the user is allowed to add web page previews to their
     *     messages
     * @param bool $can_change_info True, if the user is allowed to change the chat title, photo and other
     *     settings
     * @param bool $can_invite_users True, if the user is allowed to invite new users to the chat
     * @param bool $can_pin_messages True, if the user is allowed to pin messages
     * @param bool $can_manage_topics True, if the user is allowed to create forum topics
     * @param int $until_date Date when restrictions will be lifted for this user; unix time. If 0, then the user is
     *     restricted forever
     */
    public function __construct(
        public User $user,
        public bool $is_member,
        public bool $can_send_messages,
        public bool $can_send_audios,
        public bool $can_send_documents,
        public bool $can_send_photos,
        public bool $can_send_videos,
        public bool $can_send_video_notes,
        public bool $can_send_voice_notes,
        public bool $can_send_polls,
        public bool $can_send_other_messages,
        public bool $can_add_web_page_previews,
        public bool $can_change_info,
        public bool $can_invite_users,
        public bool $can_pin_messages,
        public bool $can_manage_topics,
        public int $until_date,
    )
    {

    }

    public static function getStatus(): string
    {
        return 'restricted';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['status'] !== self::getStatus()) {
            throw new RuntimeException("Wrong chat member status: {$data['status']}");
        }

        return new self(
            user: User::makeByArray($data['user']),
            is_member: $data['is_member'],
            can_send_messages: $data['can_send_messages'],
            can_send_audios: $data['can_send_audios'],
            can_send_documents: $data['can_send_documents'],
            can_send_photos: $data['can_send_photos'],
            can_send_videos: $data['can_send_videos'],
            can_send_video_notes: $data['can_send_video_notes'],
            can_send_voice_notes: $data['can_send_voice_notes'],
            can_send_polls: $data['can_send_polls'],
            can_send_other_messages: $data['can_send_other_messages'],
            can_add_web_page_previews: $data['can_add_web_page_previews'],
            can_change_info: $data['can_change_info'],
            can_invite_users: $data['can_invite_users'],
            can_pin_messages: $data['can_pin_messages'],
            can_manage_topics: $data['can_manage_topics'],
            until_date: $data['until_date'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'status' => self::getStatus(),
            'user' => $this->user,
            'is_member' => $this->is_member,
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
            'until_date' => $this->until_date,
        ];
    }
}
