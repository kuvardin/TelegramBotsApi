<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents changes in the status of a chat member.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatMemberUpdated extends Type
{
    /**
     * @param Chat $chat Chat the user belongs to
     * @param User $from Performer of the action, which resulted in the change
     * @param int $date Date the change was done in Unix time
     * @param ChatMember $old_chat_member Previous information about the chat member
     * @param ChatMember $new_chat_member New information about the chat member
     * @param ChatInviteLink|null $invite_link Chat invite link, which was used by the user to join the chat;
     *     for joining by invite link events only.
     * @param bool|null $via_chat_folder_invite_link True, if the user joined the chat via a chat folder invite link
     * @param bool|null $via_join_request True, if the user joined the chat after sending a direct join request without
     *      using an invite link and being approved by an administrator
     */
    public function __construct(
        public Chat $chat,
        public User $from,
        public int $date,
        public ChatMember $old_chat_member,
        public ChatMember $new_chat_member,
        public ?ChatInviteLink $invite_link = null,
        public ?bool $via_chat_folder_invite_link = null,
        public ?bool $via_join_request = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            chat: Chat::makeByArray($data['chat']),
            from: User::makeByArray($data['from']),
            date: $data['date'],
            old_chat_member: ChatMember::makeByArray($data['old_chat_member']),
            new_chat_member: ChatMember::makeByArray($data['new_chat_member']),
            invite_link: isset($data['invite_link'])
                ? ChatInviteLink::makeByArray($data['invite_link'])
                : null,
            via_chat_folder_invite_link: $data['via_chat_folder_invite_link'] ?? null,
            via_join_request: $data['via_join_request'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'chat' => $this->chat,
            'from' => $this->from,
            'date' => $this->date,
            'old_chat_member' => $this->old_chat_member,
            'new_chat_member' => $this->new_chat_member,
            'invite_link' => $this->invite_link,
            'via_chat_folder_invite_link' => $this->via_chat_folder_invite_link,
            'via_join_request' => $this->via_join_request,
        ];
    }
}
