<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a boost added to a chat or changed.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatBoostUpdated extends Type
{
    /**
     * @param Chat $chat Chat which was boosted
     * @param ChatBoost $boost Infomation about the chat boost
     */
    public function __construct(
        public Chat $chat,
        public ChatBoost $boost,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            chat: Chat::makeByArray($data['chat']),
            boost: ChatBoost::makeByArray($data['boost']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'chat' => $this->chat,
            'boost' => $this->boost,
        ];
    }
}
