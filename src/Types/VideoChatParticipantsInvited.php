<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about new members invited to a video chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class VideoChatParticipantsInvited extends Type
{
    /**
     * @var User[] $users New members that were invited to the video chat
     */
    public array $users;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->users = [];
        foreach ($data['users'] as $item_data) {
            $result->users[] = User::makeByArray($item_data);
        }
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'users' => $this->users,
        ];
    }
}
