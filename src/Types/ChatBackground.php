<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a chat background.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatBackground extends Type
{
    /**
     * @param BackgroundType $type Type of the background
     */
    public function __construct(
        public BackgroundType $type,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            type: BackgroundType::makeByArray($data['type']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
