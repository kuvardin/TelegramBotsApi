<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about a video chat ended in the chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class VideoChatEnded extends Type
{
    /**
     * @param int $duration Video chat duration in seconds
     */
    public function __construct(
        public int $duration,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            duration: $data['duration'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'duration' => $this->duration,
        ];
    }
}
