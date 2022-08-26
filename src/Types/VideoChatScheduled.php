<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about a video chat scheduled in the chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class VideoChatScheduled extends Type
{
    /**
     * @param int $start_date Point in time (Unix timestamp) when the video chat is supposed to be started by a chat
     *     administrator
     */
    public function __construct(
        public int $start_date,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            start_date: $data['start_date'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'start_date' => $this->start_date,
        ];
    }
}
