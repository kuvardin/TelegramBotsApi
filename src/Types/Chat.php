<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi;
use Kuvardin\TelegramBotsApi\Exceptions\Error;

/**
 * This object represents a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Chat implements TypeInterface
{
    public const TYPE_PRIVATE = 'private';
    public const TYPE_GROUP = 'group';
    public const TYPE_SUPERGROUP = 'supergroup';
    public const TYPE_CHANNEL = 'channel';

    /**
     * @var int Unique identifier for this chat. This number may be greater than 32 bits and some programming
     * languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits,
     * so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     */
    public int $id;

    /**
     * @var string|null Title, for supergroups, channels and group chats
     */
    public ?string $title = null;

    /**
     * @var TelegramBotsApi\Username|null Username, for private chats, supergroups and channels if available
     */
    public ?TelegramBotsApi\Username $username = null;

    /**
     * @var string|null First name of the other party in a private chat
     */
    public ?string $first_name = null;

    /**
     * @var string|null Last name of the other party in a private chat
     */
    public ?string $last_name = null;

    /**
     * @var ChatPhoto|null Chat photo. Returned only in getChat.
     */
    public ?ChatPhoto $photo = null;

    /**
     * @var string|null Description, for groups, supergroups and channel chats. Returned only in getChat.
     */
    public ?string $description = null;

    /**
     * @var string|null Chat invite link, for groups, supergroups and channel chats. Each administrator
     * in a chat generates their own invite links, so the bot must first generate the link using
     * exportChatInviteLink. Returned only in getChat.
     */
    public ?string $invite_link = null;

    /**
     * @var Message|null Pinned message, for groups, supergroups and channels. Returned only in getChat.
     */
    public ?Message $pinned_message = null;

    /**
     * @var ChatPermissions|null Default chat member permissions, for groups and supergroups.
     * Returned only in getChat.
     */
    public ?ChatPermissions $permissions = null;

    /**
     * @var int|null For supergroups, the minimum allowed delay between consecutive messages sent by each
     * unpriviledged user. Returned only in getChat.
     */
    public ?int $slow_mode_delay = null;

    /**
     * @var string|null For supergroups, name of group sticker set. Returned only in getChat.
     */
    public ?string $sticker_set_name = null;

    /**
     * @var bool|null True, if the bot can change the group sticker set. Returned only in getChat.
     */
    public ?bool $can_set_sticker_set = null;

    /**
     * @var string Type of chat, can be either self::TYPE_*
     */
    protected string $type;

    /**
     * Chat constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->setType($data['type']);

        if (isset($data['title'])) {
            $this->title = $data['title'];
        }

        if (isset($data['username'])) {
            $this->username = new TelegramBotsApi\Username($data['username']);
        }

        if (isset($data['first_name'])) {
            $this->first_name = $data['first_name'];
        }

        if (isset($data['last_name'])) {
            $this->last_name = $data['last_name'];
        }

        if (isset($data['photo'])) {
            $this->photo = $data['photo'] instanceof ChatPhoto
                ? $data['photo']
                : new ChatPhoto($data['photo']);
        }

        if (isset($data['description'])) {
            $this->description = $data['description'];
        }

        if (isset($data['invite_link'])) {
            $this->invite_link = $data['invite_link'];
        }

        if (isset($data['pinned_message'])) {
            $this->pinned_message = $data['pinned_message'] instanceof Message
                ? $data['pinned_message']
                : new Message($data['pinned_message']);
        }

        if (isset($data['permissions'])) {
            $this->permissions = $data['permissions'] instanceof ChatPermissions
                ? $data['permissions']
                : new ChatPermissions($data['permissions']);
        }

        if (isset($data['slow_mode_delay'])) {
            $this->slow_mode_delay = $data['slow_mode_delay'];
        }

        if (isset($data['sticker_set_name'])) {
            $this->sticker_set_name = $data['sticker_set_name'];
        }

        if (isset($data['can_set_sticker_set'])) {
            $this->can_set_sticker_set = $data['can_set_sticker_set'];
        }
    }

    /**
     * @param int $id Unique identifier for this chat. This number may be greater than 32 bits and some
     * programming languages may have difficulty/silent defects in interpreting it. But it is smaller than
     * 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier
     * @param string $type Type of chat, can be either self::TYPE_*
     * @return Chat
     */
    public static function make(int $id, string $type): self
    {
        return new self([
            'id' => $id,
            'type' => $type,
        ]);
    }

    /**
     * @param string $type
     * @return bool
     */
    public static function checkType(string $type): bool
    {
        return $type === self::TYPE_CHANNEL ||
            $type === self::TYPE_GROUP ||
            $type === self::TYPE_PRIVATE ||
            $type === self::TYPE_SUPERGROUP;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        if (!self::checkType($type)) {
            throw new Error("Unknown chat type: $type");
        }
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'username' => $this->username->getShort(),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'photo' => $this->photo,
            'description' => $this->description,
            'invite_link' => $this->invite_link,
            'pinned_message' => $this->pinned_message,
            'permissions' => $this->permissions,
            'slow_mode_delay' => $this->slow_mode_delay,
            'sticker_set_name' => $this->sticker_set_name,
            'can_set_sticker_set' => $this->can_set_sticker_set,
        ];
    }
}
