<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\ChatType;
use Kuvardin\TelegramBotsApi\Type;
use Kuvardin\TelegramBotsApi\Username;

/**
 * This object represents a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Chat extends Type
{
    /**
     * @var int $id Unique identifier for this chat. This number may have more than 32 significant bits and some
     *     programming languages may have difficulty/silent defects in interpreting it. But it has at most 52
     *     significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this
     *     identifier.
     */
    public int $id;

    /**
     * @var ChatType $type Type of chat, can be Enums\ChatType::*
     */
    public ChatType $type;

    /**
     * @var string|null $title Title, for supergroups, channels and group chats
     */
    public ?string $title = null;

    /**
     * @var Username|null $username Username, for private chats, supergroups and channels if available
     */
    public ?Username $username = null;

    /**
     * @var string|null $first_name First name of the other party in a private chat
     */
    public ?string $first_name = null;

    /**
     * @var string|null $last_name Last name of the other party in a private chat
     */
    public ?string $last_name = null;

    /**
     * @var ChatPhoto|null $photo Chat photo. Returned only in <a
     *     href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?ChatPhoto $photo = null;

    /**
     * @var string|null $bio Bio of the other party in a private chat. Returned only in <a
     *     href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?string $bio = null;

    /**
     * @var bool|null $has_private_forwards True, if privacy settings of the other party in the private chat allows to
     *     use <code>tg://user?id=<user_id></code> links only in chats with the user. Returned only in <a
     *     href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?bool $has_private_forwards = null;

    /**
     * @var string|null $description Description, for groups, supergroups and channel chats. Returned only in <a
     *     href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?string $description = null;

    /**
     * @var string|null $invite_link Primary invite link, for groups, supergroups and channel chats. Returned only in
     *     <a href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?string $invite_link = null;

    /**
     * @var Message|null $pinned_message The most recent pinned message (by sending date). Returned only in <a
     *     href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?Message $pinned_message = null;

    /**
     * @var ChatPermissions|null $permissions Default chat member permissions, for groups and supergroups. Returned
     *     only in <a href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?ChatPermissions $permissions = null;

    /**
     * @var int|null $slow_mode_delay For supergroups, the minimum allowed delay between consecutive messages sent by
     *     each unpriviledged user; in seconds. Returned only in <a
     *     href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?int $slow_mode_delay = null;

    /**
     * @var int|null $message_auto_delete_time The time after which all messages sent to the chat will be automatically
     *     deleted; in seconds. Returned only in <a href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?int $message_auto_delete_time = null;

    /**
     * @var bool|null $has_protected_content True, if messages from the chat can't be forwarded to other chats.
     *     Returned only in <a href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?bool $has_protected_content = null;

    /**
     * @var string|null $sticker_set_name For supergroups, name of group sticker set. Returned only in <a
     *     href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?string $sticker_set_name = null;

    /**
     * @var bool|null $can_set_sticker_set <em>True</em>, if the bot can change the group sticker set. Returned only in
     *     <a href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?bool $can_set_sticker_set = null;

    /**
     * @var int|null $linked_chat_id Unique identifier for the linked chat, i.e. the discussion group identifier for a
     *     channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits and
     *     some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52
     *     bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     *     Returned only in <a href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?int $linked_chat_id = null;

    /**
     * @var ChatLocation|null $location For supergroups, the location to which the supergroup is connected. Returned
     *     only in <a href="https://core.telegram.org/bots/api#getchat">getChat</a>.
     */
    public ?ChatLocation $location = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->id = $data['id'];
        $result->type = ChatType::from($data['type']);
        $result->title = $data['title'] ?? null;
        $result->username = isset($data['username'])
            ? new Username($data['username'])
            : null;
        $result->first_name = $data['first_name'] ?? null;
        $result->last_name = $data['last_name'] ?? null;
        $result->photo = isset($data['photo'])
            ? ChatPhoto::makeByArray($data['photo'])
            : null;
        $result->bio = $data['bio'] ?? null;
        $result->has_private_forwards = $data['has_private_forwards'] ?? null;
        $result->description = $data['description'] ?? null;
        $result->invite_link = $data['invite_link'] ?? null;
        $result->pinned_message = isset($data['pinned_message'])
            ? Message::makeByArray($data['pinned_message'])
            : null;
        $result->permissions = isset($data['permissions'])
            ? ChatPermissions::makeByArray($data['permissions'])
            : null;
        $result->slow_mode_delay = $data['slow_mode_delay'] ?? null;
        $result->message_auto_delete_time = $data['message_auto_delete_time'] ?? null;
        $result->has_protected_content = $data['has_protected_content'] ?? null;
        $result->sticker_set_name = $data['sticker_set_name'] ?? null;
        $result->can_set_sticker_set = $data['can_set_sticker_set'] ?? null;
        $result->linked_chat_id = $data['linked_chat_id'] ?? null;
        $result->location = isset($data['location'])
            ? ChatLocation::makeByArray($data['location'])
            : null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type->value,
            'title' => $this->title,
            'username' => $this->username?->getShort(),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'photo' => $this->photo,
            'bio' => $this->bio,
            'has_private_forwards' => $this->has_private_forwards,
            'description' => $this->description,
            'invite_link' => $this->invite_link,
            'pinned_message' => $this->pinned_message,
            'permissions' => $this->permissions,
            'slow_mode_delay' => $this->slow_mode_delay,
            'message_auto_delete_time' => $this->message_auto_delete_time,
            'has_protected_content' => $this->has_protected_content,
            'sticker_set_name' => $this->sticker_set_name,
            'can_set_sticker_set' => $this->can_set_sticker_set,
            'linked_chat_id' => $this->linked_chat_id,
            'location' => $this->location,
        ];
    }
}
