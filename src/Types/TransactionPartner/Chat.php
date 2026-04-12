<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\TransactionPartner;

use Kuvardin\TelegramBotsApi\Types\Gift;
use Kuvardin\TelegramBotsApi\Types\TransactionPartner;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\Chat as TelegramChat;

/**
 * Describes a transaction with a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Chat extends TransactionPartner
{
    /**
     * @param TelegramChat $chat Information about the chat
     * @param Gift|null $gift The gift sent to the chat by the bot
     * */
    public function __construct(
        public TelegramChat $chat,
        public Gift|null $gift = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'chat';
    }
    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong transaction partner type: {$data['type']}");
        }

        return new self(
            chat: TelegramChat::makeByArray($data['chat']),
            gift: isset($data['gift'])
                ? Gift::makeByArray($data['gift'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'chat' => $this->chat,
            'gift' => $this->gift,
        ];
    }
}
