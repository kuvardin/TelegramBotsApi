<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\StoryAreaType;

use Kuvardin\TelegramBotsApi\Types\StoryAreaType;
use RuntimeException;

/**
 * Describes a story area pointing to an HTTP or tg:// link. Currently, a story can have up to 3 link areas.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Link extends StoryAreaType
{
    /**
     * @param string $url HTTP or tg:// URL to be opened when the area is clicked
     */
    public function __construct(
        public string $url,
    )
    {

    }

    public static function getType(): string
    {
        return 'link';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong story area types type: {$data['type']}");
        }

        return new self(
            url: $data['url'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'url' => $this->url,
        ];
    }
}
