<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * Custom type for Bot::promoteChatMember()
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class AdministratorPermissions implements TypeInterface
{
    /**
     * @var bool|null True, if the administrator can change chat title, photo and other settings
     */
    public ?bool $can_change_info = null;

    /**
     * @var bool|null True, if the administrator can create channel posts, channels only
     */
    public ?bool $can_post_messages = null;

    /**
     * @var bool|null True, if the administrator can edit messages of other users and can pin messages, channels only
     */
    public ?bool $can_edit_messages = null;

    /**
     * @var bool|null True, if the administrator can delete messages of other users
     */
    public ?bool $can_delete_messages = null;

    /**
     * @var bool|null True, if the administrator can invite new users to the chat
     */
    public ?bool $can_invite_users = null;

    /**
     * @var bool|null True, if the administrator can restrict, ban or unban chat members
     */
    public ?bool $can_restrict_members = null;

    /**
     * @var bool|null True, if the administrator can pin messages, supergroups only
     */
    public ?bool $can_pin_messages = null;

    /**
     * @var bool|null True, if the administrator can add new administrators with a subset of his own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by him)
     */
    public ?bool $can_promote_members = null;

    /**
     * AdministratorPermissions constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (isset($data['can_change_info'])) {
            $this->can_change_info = $data['can_change_info'];
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

        if (isset($data['can_invite_users'])) {
            $this->can_invite_users = $data['can_invite_users'];
        }

        if (isset($data['can_restrict_members'])) {
            $this->can_restrict_members = $data['can_restrict_members'];
        }

        if (isset($data['can_pin_messages'])) {
            $this->can_pin_messages = $data['can_pin_messages'];
        }

        if (isset($data['can_promote_members'])) {
            $this->can_promote_members = $data['can_promote_members'];
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
            'can_change_info' => $this->can_change_info,
            'can_post_messages' => $this->can_post_messages,
            'can_edit_messages' => $this->can_edit_messages,
            'can_delete_messages' => $this->can_delete_messages,
            'can_invite_users' => $this->can_invite_users,
            'can_restrict_members' => $this->can_restrict_members,
            'can_pin_messages' => $this->can_pin_messages,
            'can_promote_members' => $this->can_promote_members,
        ];
    }
}