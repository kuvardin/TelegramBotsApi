<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object contains information about one member of a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class ChatMember extends Type
{
    /**
     * The member's status in the chat
     */
    abstract public static function getStatus(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['status']) {
            ChatMember\Administrator::getStatus() => ChatMember\Administrator::makeByArray($data),
            ChatMember\Banned::getStatus() => ChatMember\Banned::makeByArray($data),
            ChatMember\Left::getStatus() => ChatMember\Left::makeByArray($data),
            ChatMember\Member::getStatus() => ChatMember\Member::makeByArray($data),
            ChatMember\Owner::getStatus() => ChatMember\Owner::makeByArray($data),
            ChatMember\Restricted::getStatus() => ChatMember\Restricted::makeByArray($data),
            default => throw new RuntimeException("Unknown chat member status: {$data['status']}"),
        };
    }

    abstract public function getRequestData(): array;
}
