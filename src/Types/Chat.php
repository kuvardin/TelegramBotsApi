<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this class represents a chat.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Chat implements TypeInterface
{
    public const TYPE_PRIVATE = 'private';
    public const TYPE_GROUP = 'group';
    public const TYPE_SUPERGROUP = 'supergroup';
    public const TYPE_CHANNEL = 'channel';

    /**
     * @var string Unique identifier for this chat. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     */
    public $id;

    /**
     * @var string Type of chat. One of self::TYPE_* constants
     */
    public $type;

    /**
     * @var string|null Title, for supergroups, channels and group chats
     */
    public $title;

    /**
     * @var string|null Username, for private chats, supergroups and channels if available
     */
    public $username;

    /**
     * @var string|null First name of the other party in a private chat
     */
    public $first_name;

    /**
     * @var string|null Last name of the other party in a private chat
     */
    public $last_name;

    /**
     * @var bool|null True if a group has ‘All Members Are Admins’ enabled.
     */
    public $all_members_are_administrators;

    /**
     * @var ChatPhoto|null Chat photo. Returned only in getChat.
     */
    public $photo;

    /**
     * @var string|null Description, for supergroups and channel chats. Returned only in getChat.
     */
    public $description;

    /**
     * @var string|null Chat invite link, for supergroups and channel chats. Each administrator in a chat generates their own invite links, so the bot must first generate the link using exportChatInviteLink. Returned only in getChat.
     */
    public $invite_link;

    /**
     * @var Message|null Pinned message, for groups, supergroups and channels. Returned only in getChat.
     */
    public $pinned_message;

    /**
     * @var string|null For supergroups, name of group sticker set. Returned only in getChat.
     */
    public $sticker_set_name;

    /**
     * @var bool|null True, if the bot can change the group sticker set. Returned only in getChat.
     */
    public $can_set_sticker_set;

    /**
     * Chat constructor.
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->setType($data['type']);
        $this->title = $data['title'] ?? null;
        $this->username = isset($data['username']) ? new TelegramBotsApi\Username($data['username']) : null;
        $this->first_name = $data['first_name'] ?? null;
        $this->last_name = $data['last_name'] ?? null;
        $this->all_members_are_administrators = $data['all_members_are_administrators'] ?? null;
        if (isset($data['photo'])) {
            $this->photo = $data['photo'] instanceof ChatPhoto ? $data['photo'] : new ChatPhoto($data['photo']);
        }
        $this->description = $data['description'] ?? null;
        $this->invite_link = $data['invite_link'] ?? null;
        if (isset($data['pinned_message'])) {
            $this->pinned_message = $data['pinned_message'] instanceof Message ? $data['pinned_message'] : new Message($data['pinned_message']);
        }
        $this->sticker_set_name = $data['sticker_set_name'] ?? null;
        $this->can_set_sticker_set = $data['can_set_sticker_set'] ?? null;
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
            'username' => !empty($this->username) ? $this->username->getShort() : null,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'photo' => $this->photo,
            'description' => $this->description,
            'invite_link' => $this->invite_link,
            'pinned_message' => $this->pinned_message,
            'sticker_set_name' => $this->sticker_set_name,
            'can_set_sticker_set' => $this->can_set_sticker_set,
        ];
    }

    /**
     * @param string $type
     * @return Chat
     * @throws Error
     */
    private function setType(string $type): self
    {
        switch ($type) {
            case self::TYPE_PRIVATE:
            case self::TYPE_GROUP:
            case self::TYPE_CHANNEL:
            case self::TYPE_SUPERGROUP:
                $this->type = $type;
                break;
            default:
                throw new Error("Unknown type: {$type}");
        }
        return $this;
    }

    /**
     * @param string $id
     * @param string $type
     * @return Chat
     * @throws Error
     */
    public static function make(string $id, string $type): self
    {
        return new self([
            'id' => $id,
            'type' => $type,
        ]);
    }
}