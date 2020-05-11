<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * Describes actions that a non-administrator user is allowed to take in a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatPermissions implements TypeInterface
{
    /**
     * @var bool|null True, if the user is allowed to send text messages, contacts, locations and venues
     */
    public ?bool $can_send_messages = null;

    /**
     * @var bool|null True, if the user is allowed to send audios, documents, photos, videos, video notes
     * and voice notes, implies can_send_messages
     */
    public ?bool $can_send_media_messages = null;

    /**
     * @var bool|null True, if the user is allowed to send polls, implies can_send_messages
     */
    public ?bool $can_send_polls = null;

    /**
     * @var bool|null True, if the user is allowed to send animations, games, stickers and use inline bots,
     * implies can_send_media_messages
     */
    public ?bool $can_send_other_messages = null;

    /**
     * @var bool|null True, if the user is allowed to add web page previews to their messages,
     * implies can_send_media_messages
     */
    public ?bool $can_add_web_page_previews = null;

    /**
     * @var bool|null True, if the user is allowed to change the chat title, photo and other settings.
     * Ignored in public supergroups
     */
    public ?bool $can_change_info = null;

    /**
     * @var bool|null True, if the user is allowed to invite new users to the chat
     */
    public ?bool $can_invite_users = null;

    /**
     * @var bool|null True, if the user is allowed to pin messages. Ignored in public supergroups
     */
    public ?bool $can_pin_messages = null;

    /**
     * ChatPermissions constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (isset($data['can_send_messages'])) {
            $this->can_send_messages = $data['can_send_messages'];
        }

        if (isset($data['can_send_media_messages'])) {
            $this->can_send_media_messages = $data['can_send_media_messages'];
        }

        if (isset($data['can_send_polls'])) {
            $this->can_send_polls = $data['can_send_polls'];
        }

        if (isset($data['can_send_other_messages'])) {
            $this->can_send_other_messages = $data['can_send_other_messages'];
        }

        if (isset($data['can_add_web_page_previews'])) {
            $this->can_add_web_page_previews = $data['can_add_web_page_previews'];
        }

        if (isset($data['can_change_info'])) {
            $this->can_change_info = $data['can_change_info'];
        }

        if (isset($data['can_invite_users'])) {
            $this->can_invite_users = $data['can_invite_users'];
        }

        if (isset($data['can_pin_messages'])) {
            $this->can_pin_messages = $data['can_pin_messages'];
        }
    }

    /**
     * @return static
     */
    public static function make(): self
    {
        return new self([
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
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
        ];
    }
}
