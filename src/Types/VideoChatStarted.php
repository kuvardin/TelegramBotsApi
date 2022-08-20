<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about a video chat started in the chat. Currently holds no information.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class VideoChatStarted extends Type
{
    public static function makeByArray(array $data): self
    {
        $result = new self;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
        ];
    }
}
