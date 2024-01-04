<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a change of a reaction on a message performed by a user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MessageReactionUpdated extends Type
{
    /**
     * @param Chat $chat The chat containing the message the user reacted to
     * @param int $message_id Unique identifier of the message inside the chat
     * @param int $date Date of the change in Unix time
     * @param ReactionType[] $old_reaction Previous list of reaction types that were set by the user
     * @param ReactionType[] $new_reaction New list of reaction types that have been set by the user
     * @param User|null $user The user that changed the reaction, if the user isn't anonymous
     * @param Chat|null $actor_chat The chat on behalf of which the reaction was changed, if the user is anonymous
     */
    public function __construct(
        public Chat $chat,
        public int $message_id,
        public int $date,
        public array $old_reaction,
        public array $new_reaction,
        public ?User $user = null,
        public ?Chat $actor_chat = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            chat: Chat::makeByArray($data['chat']),
            message_id: $data['message_id'],
            date: $data['date'],
            old_reaction: array_map(
                static fn(array $item_data) => ReactionType::makeByArray($item_data),
                $data['old_reaction'],
            ),
            new_reaction: array_map(
                static fn(array $item_data) => ReactionType::makeByArray($item_data),
                $data['new_reaction'],
            ),
            user: isset($data['user'])
                ? User::makeByArray($data['user'])
                : null,
            actor_chat: isset($data['actor_chat'])
                ? Chat::makeByArray($data['actor_chat'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'chat' => $this->chat,
            'message_id' => $this->message_id,
            'user' => $this->user,
            'actor_chat' => $this->actor_chat,
            'date' => $this->date,
            'old_reaction' => $this->old_reaction,
            'new_reaction' => $this->new_reaction,
        ];
    }
}
