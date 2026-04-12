<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a clickable area on a story media.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class StoryArea extends Type
{
    /**
     * @param StoryAreaPosition $position Position of the area
     * @param StoryAreaType $type Type of the area
     */
    public function __construct(
        public StoryAreaPosition $position,
        public StoryAreaType $type,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            position: StoryAreaPosition::makeByArray($data['position']),
            type: StoryAreaType::makeByArray($data['type']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'position' => $this->position,
            'type' => $this->type,
        ];
    }
}
