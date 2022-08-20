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
     * @var User $user Information about the user
     */
    public User $user;

    /**
     * @var bool $is_member <em>True</em>, if the user is a member of the chat at the moment of the request
     */
    public bool $is_member;

    /**
     * @var bool $can_change_info <em>True</em>, if the user is allowed to change the chat title, photo and other
     *     settings
     */
    public bool $can_change_info;

    /**
     * @var bool $can_invite_users <em>True</em>, if the user is allowed to invite new users to the chat
     */
    public bool $can_invite_users;

    /**
     * @var bool $can_pin_messages <em>True</em>, if the user is allowed to pin messages
     */
    public bool $can_pin_messages;

    /**
     * @var bool $can_send_messages <em>True</em>, if the user is allowed to send text messages, contacts, locations
     *     and venues
     */
    public bool $can_send_messages;

    /**
     * @var bool $can_send_media_messages <em>True</em>, if the user is allowed to send audios, documents, photos,
     *     videos, video notes and voice notes
     */
    public bool $can_send_media_messages;

    /**
     * @var bool $can_send_polls <em>True</em>, if the user is allowed to send polls
     */
    public bool $can_send_polls;

    /**
     * @var bool $can_send_other_messages <em>True</em>, if the user is allowed to send animations, games, stickers and
     *     use inline bots
     */
    public bool $can_send_other_messages;

    /**
     * @var bool $can_add_web_page_previews <em>True</em>, if the user is allowed to add web page previews to their
     *     messages
     */
    public bool $can_add_web_page_previews;

    /**
     * @var int $until_date Date when restrictions will be lifted for this user; unix time. If 0, then the user is
     *     restricted forever
     */
    public int $until_date;

    public static function getStatus(): string
    {
        return 'restricted';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['status'] !== self::getStatus()) {
            throw new RuntimeException("Wrong chat member status: {$data['status']}");
        }

        $result->user = User::makeByArray($data['user']);
        $result->is_member = $data['is_member'];
        $result->can_change_info = $data['can_change_info'];
        $result->can_invite_users = $data['can_invite_users'];
        $result->can_pin_messages = $data['can_pin_messages'];
        $result->can_send_messages = $data['can_send_messages'];
        $result->can_send_media_messages = $data['can_send_media_messages'];
        $result->can_send_polls = $data['can_send_polls'];
        $result->can_send_other_messages = $data['can_send_other_messages'];
        $result->can_add_web_page_previews = $data['can_add_web_page_previews'];
        $result->until_date = $data['until_date'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'status' => self::getStatus(),
            'user' => $this->user,
            'is_member' => $this->is_member,
            'can_change_info' => $this->can_change_info,
            'can_invite_users' => $this->can_invite_users,
            'can_pin_messages' => $this->can_pin_messages,
            'can_send_messages' => $this->can_send_messages,
            'can_send_media_messages' => $this->can_send_media_messages,
            'can_send_polls' => $this->can_send_polls,
            'can_send_other_messages' => $this->can_send_other_messages,
            'can_add_web_page_previews' => $this->can_add_web_page_previews,
            'until_date' => $this->until_date,
        ];
    }
}
