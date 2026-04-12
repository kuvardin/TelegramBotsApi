<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\StoryAreaType;

use Kuvardin\TelegramBotsApi\Types\StoryAreaType;
use RuntimeException;

/**
 * Describes a story area pointing to a unique gift. Currently, a story can have at most 1 unique gift area.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UniqueGift extends StoryAreaType
{
    /**
     * @param string $name Unique name of the gift
     */
    public function __construct(
        public string $name,
    )
    {

    }

    public static function getType(): string
    {
        return 'unique_gift';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong story area types type: {$data['type']}");
        }

        return new self(
            name: $data['name'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'name' => $this->name,
        ];
    }
}
