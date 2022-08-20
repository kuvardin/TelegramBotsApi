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
     * @var Chat $chat Chat the user belongs to
     */
    public Chat $chat;

    /**
     * @var User $from Performer of the action, which resulted in the change
     */
    public User $from;

    /**
     * @var int $date Date the change was done in Unix time
     */
    public int $date;

    /**
     * @var ChatMember $old_chat_member Previous information about the chat member
     */
    public ChatMember $old_chat_member;

    /**
     * @var ChatMember $new_chat_member New information about the chat member
     */
    public ChatMember $new_chat_member;

    /**
     * @var ChatInviteLink|null $invite_link Chat invite link, which was used by the user to join the chat; for joining
     *     by invite link events only.
     */
    public ?ChatInviteLink $invite_link = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->chat = Chat::makeByArray($data['chat']);
        $result->from = User::makeByArray($data['from']);
        $result->date = $data['date'];
        $result->old_chat_member = ChatMember::makeByArray($data['old_chat_member']);
        $result->new_chat_member = ChatMember::makeByArray($data['new_chat_member']);
        $result->invite_link = isset($data['invite_link'])
            ? ChatInviteLink::makeByArray($data['invite_link'])
            : null;
        return $result;
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
        ];
    }
}
