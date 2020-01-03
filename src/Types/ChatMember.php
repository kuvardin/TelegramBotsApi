<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * This object contains information about one member of a chat.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
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
    public User $user;

    /**
     * @var string|null Owner and administrators only. Custom title for this user
     */
    public ?string $custom_title;

    /**
     * @var int|null Restricted and kicked only. Date when restrictions will be lifted for this user;
     * unix time
     */
    public ?int $until_date;

    /**
     * @var bool|null Administrators only. True, if the bot is allowed to edit administrator privileges
     * of that user
     */
    public ?bool $can_be_edited;

    /**
     * @var bool|null Administrators only. True, if the administrator can post in the channel;
     * channels only
     */
    public ?bool $can_post_messages;

    /**
     * @var bool|null Administrators only. True, if the administrator can edit messages of other users
     * and can pin messages; channels only
     */
    public ?bool $can_edit_messages;

    /**
     * @var bool|null Administrators only. True, if the administrator can delete messages of other users
     */
    public ?bool $can_delete_messages;

    /**
     * @var bool|null Administrators only. True, if the administrator can restrict, ban or unban chat members
     */
    public ?bool $can_restrict_members;

    /**
     * @var bool|null Administrators only. True, if the administrator can add new administrators with a subset
     * of his own privileges or demote administrators that he has promoted, directly or indirectly
     * (promoted by administrators that were appointed by the user)
     */
    public ?bool $can_promote_members;

    /**
     * @var bool|null Administrators and restricted only. True, if the user is allowed to change the chat title,
     * photo and other settings
     */
    public ?bool $can_change_info;

    /**
     * @var bool|null Administrators and restricted only. True, if the user is allowed to invite new users
     * to the chat
     */
    public ?bool $can_invite_users;

    /**
     * @var bool|null Administrators and restricted only. True, if the user is allowed to pin messages;
     * groups and supergroups only
     */
    public ?bool $can_pin_messages;

    /**
     * @var bool|null Restricted only. True, if the user is a member of the chat at the moment of the request
     */
    public ?bool $is_member;

    /**
     * @var bool|null Restricted only. True, if the user is allowed to send text messages, contacts,
     * locations and venues
     */
    public ?bool $can_send_messages;

    /**
     * @var bool|null Restricted only. True, if the user is allowed to send audios, documents, photos,
     * videos, video notes and voice notes
     */
    public ?bool $can_send_media_messages;

    /**
     * @var bool|null Restricted only. True, if the user is allowed to send polls
     */
    public ?bool $can_send_polls;

    /**
     * @var bool|null Restricted only. True, if the user is allowed to send animations, games, stickers
     * and use inline bots
     */
    public ?bool $can_send_other_messages;

    /**
     * @var bool|null Restricted only. True, if the user is allowed to add web page previews to their messages
     */
    public ?bool $can_add_web_page_previews;

    /**
     * @var string The member's status in the chat. Can be self::STATUS_*
     */
    protected string $status;

    /**
     * ChatMember constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->user = $data['user'] instanceof User
            ? $data['user']
            : new User($data['user']);
        $this->setStatus($data['status']);

        if (isset($data['custom_title'])) {
            $this->custom_title = $data['custom_title'];
        }

        if (isset($data['until_date'])) {
            $this->until_date = $data['until_date'];
        }

        if (isset($data['can_be_edited'])) {
            $this->can_be_edited = $data['can_be_edited'];
        }

        if (isset($data['can_post_messages'])) {
            $this->can_post_messages = $data['can_post_messages'];
        }

        if (isset($data['can_edit_messages'])) {
            $this->can_edit_messages = $data['can_edit_messages'];
        }

        if (isset($data['can_delete_messages'])) {
            $this->can_delete_messages = $data['can_delete_messages'];
        }

        if (isset($data['can_restrict_members'])) {
            $this->can_restrict_members = $data['can_restrict_members'];
        }

        if (isset($data['can_promote_members'])) {
            $this->can_promote_members = $data['can_promote_members'];
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

        if (isset($data['is_member'])) {
            $this->is_member = $data['is_member'];
        }

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
    }

    /**
     * @param User $user Information about the user
     * @param string $status The member's status in the chat. Can be self::STATUS_*
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
        return $status === self::STATUS_CREATOR ||
            $status === self::STATUS_ADMINISTRATOR ||
            $status === self::STATUS_MEMBER ||
            $status === self::STATUS_RESTRICTED ||
            $status === self::STATUS_LEFT ||
            $status === self::STATUS_KICKED;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @throws Error
     */
    public function setStatus(string $status): void
    {
        if (!self::checkStatus($status)) {
            throw new Error("Unknown chat member status: $status");
        }
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'user' => $this->user,
            'status' => $this->status,
            'custom_title' => $this->custom_title,
            'until_date' => $this->until_date,
            'can_be_edited' => $this->can_be_edited,
            'can_post_messages' => $this->can_post_messages,
            'can_edit_messages' => $this->can_edit_messages,
            'can_delete_messages' => $this->can_delete_messages,
            'can_restrict_members' => $this->can_restrict_members,
            'can_promote_members' => $this->can_promote_members,
            'can_change_info' => $this->can_change_info,
            'can_invite_users' => $this->can_invite_users,
            'can_pin_messages' => $this->can_pin_messages,
            'is_member' => $this->is_member,
            'can_send_messages' => $this->can_send_messages,
            'can_send_media_messages' => $this->can_send_media_messages,
            'can_send_polls' => $this->can_send_polls,
            'can_send_other_messages' => $this->can_send_other_messages,
            'can_add_web_page_previews' => $this->can_add_web_page_previews,
        ];
    }
}