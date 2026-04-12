<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\StoryAreaType;

use Kuvardin\TelegramBotsApi\Types\StoryAreaType;
use RuntimeException;

/**
 * Describes a story area containing weather information. Currently, a story can have up to 3 weather areas.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Weather extends StoryAreaType
{
    /**
     * @param float $temperature Temperature, in degree Celsius
     * @param string $emoji Emoji representing the weather
     * @param int $background_color A color of the area background in the ARGB format
     */
    public function __construct(
        public float $temperature,
        public string $emoji,
        public int $background_color,
    )
    {

    }

    public static function getType(): string
    {
        return 'weather';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong story area types type: {$data['type']}");
        }

        return new self(
            temperature: $data['temperature'],
            emoji: $data['emoji'],
            background_color: $data['background_color'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'temperature' => $this->temperature,
            'emoji' => $this->emoji,
            'background_color' => $this->background_color,
        ];
    }
}
