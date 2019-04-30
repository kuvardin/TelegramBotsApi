<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object contains information about one member of a chat.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class ChatMember implements TypeInterface
{
    public const STATUS_CREATOR = 'creator';
    public const STATUS_ADMINISTRATOR = 'administrator';
    public const STATUS_MEMBER = 'member';
    public const STATUS_RESTRICTED = 'restricted';
    public const STATUS_LEFT = 'left';
    public const STATUS_KICKED = 'kicked';

    /**
     * @var User Information about the user
     */
    public $user;

    /**
     * @var string The member's status in the chat. Can be one of self::STATUS_*
     */
    public $status;

    /**
     * @var int|null Restricted and kicked only. Date when restrictions will be lifted for this user, unix time
     */
    public $until_date;

    /**
     * @var bool|int Administrators only. True, if the bot is allowed to edit administrator privileges of that user
     */
    public $can_be_edited;

    /**
     * @var bool|null Administrators only. True, if the administrator can change the chat title, photo and other settings
     */
    public $can_change_info;

    /**
     * @var bool|null Administrators only. True, if the administrator can post in the channel, channels only
     */
    public $can_post_messages;

    /**
     * @var bool|null Administrators only. True, if the administrator can edit messages of other users and can pin messages, channels only
     */
    public $can_edit_messages;

    /**
     * @var bool|null Administrators only. True, if the administrator can delete messages of other users
     */
    public $can_delete_messages;

    /**
     * @var bool|null Administrators only. True, if the administrator can invite new users to the chat
     */
    public $can_invite_users;

    /**
     * @var bool|null Administrators only. True, if the administrator can restrict, ban or unban chat members
     */
    public $can_restrict_members;

    /**
     * @var bool|null Administrators only. True, if the administrator can pin messages, supergroups only
     */
    public $can_pin_messages;

    /**
     * @var bool|null Administrators only. True, if the administrator can add new administrators with a subset of his own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by the user)
     */
    public $can_promote_members;

    /**
     * @var bool|null Restricted only. True, if the user is a member of the chat at the moment of the request
     */
    public $is_member;

    /**
     * @var bool|null Restricted only. True, if the user can send text messages, contacts, locations and venues
     */
    public $can_send_messages;

    /**
     * @var bool|null Restricted only. True, if the user can send audios, documents, photos, videos, video notes and voice notes, implies can_send_messages
     */
    public $can_send_media_messages;

    /**
     * @var bool|null Restricted only. True, if the user can send animations, games, stickers and use inline bots, implies can_send_media_messages
     */
    public $can_send_other_messages;

    /**
     * @var bool|null Restricted only. True, if user may add web page previews to his messages, implies can_send_media_messages
     */
    public $can_add_web_page_previews;

    /**
     * ChatMember constructor.
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->user = $data['user'] instanceof User ? $data['user'] : new User($data['user']);
        $this->setStatus($data['status']);
        $this->until_date = $data['until_date'] ?? null;
        $this->can_be_edited = $data['can_be_edited'] ?? null;
        $this->can_change_info = $data['can_change_info'] ?? null;
        $this->can_post_messages = $data['can_post_messages'] ?? null;
        $this->can_edit_messages = $data['can_edit_messages'] ?? null;
        $this->can_delete_messages = $data['can_delete_messages'] ?? null;
        $this->can_invite_users = $data['can_invite_users'] ?? null;
        $this->can_restrict_members = $data['can_restrict_members'] ?? null;
        $this->can_pin_messages = $data['can_pin_messages'] ?? null;
        $this->can_promote_members = $data['can_promote_members'] ?? null;
        $this->is_member = $data['is_member'] ?? null;
        $this->can_send_messages = $data['can_send_messages'] ?? null;
        $this->can_send_media_messages = $data['can_send_media_messages'] ?? null;
        $this->can_send_other_messages = $data['can_send_other_messages'] ?? null;
        $this->can_add_web_page_previews = $data['can_add_web_page_previews'] ?? null;
    }

    /**
     * @param string $status
     * @throws Error
     */
    public function setStatus(string $status): void
    {
        switch ($status) {
            case self::STATUS_ADMINISTRATOR:
            case self::STATUS_CREATOR:
            case self::STATUS_KICKED:
            case self::STATUS_LEFT:
            case self::STATUS_MEMBER:
            case self::STATUS_RESTRICTED:
                $this->status = $status;
                break;
            default:
                throw new Error("Unknown status: {$status}");
        }
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'user' => $this->user,
            'status' => $this->status,
            'until_date' => $this->until_date,
            'can_be_edited' => $this->can_be_edited,
            'can_change_info' => $this->can_change_info,
            'can_post_messages' => $this->can_post_messages,
            'can_edit_messages' => $this->can_edit_messages,
            'can_delete_messages' => $this->can_delete_messages,
            'can_invite_users' => $this->can_invite_users,
            'can_restrict_members' => $this->can_restrict_members,
            'can_pin_messages' => $this->can_pin_messages,
            'can_promote_members' => $this->can_promote_members,
            'is_member' => $this->is_member,
            'can_send_messages' => $this->can_send_messages,
            'can_send_media_messages' => $this->can_send_media_messages,
            'can_send_other_messages' => $this->can_send_other_messages,
            'can_add_web_page_previews' => $this->can_add_web_page_previews,
        ];
    }

    /**
     * @param User $user
     * @param string $status
     * @return ChatMember
     * @throws Error
     */
    public static function make(User $user, string $status): self
    {
        return new self([
            'user' => $user,
            'status' => $status,
        ]);
    }

    /**
     * @param string $status
     * @return bool
     */
    public static function checkStatus(string $status): bool
    {
        switch ($status) {
            case self::STATUS_CREATOR:
            case self::STATUS_ADMINISTRATOR:
            case self::STATUS_MEMBER:
            case self::STATUS_RESTRICTED:
            case self::STATUS_LEFT:
            case self::STATUS_KICKED:
                return true;
        }
        return false;
    }
}