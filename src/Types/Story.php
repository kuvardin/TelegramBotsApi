<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a story.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Story extends Type
{
    /**
     * @param Chat $chat Chat that posted the story
     * @param int $id Unique identifier for the story in the chat
     */
    public function __construct(
        public Chat $chat,
        public int $id,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            chat: Chat::makeByArray($data['chat']),
            id: $data['id'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'chat' => $this->chat,
            'id' => $this->id,
        ];
    }
}
