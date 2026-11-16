<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMedia;

use Kuvardin\TelegramBotsApi\Types\InputMedia;
use Kuvardin\TelegramBotsApi\Types\InputPollMedia;
use RuntimeException;

/**
 * Represents an HTTP link to be sent.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Link extends InputMedia implements InputPollMedia
{
    /**
     * @param string $url HTTP URL of the link
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
            throw new RuntimeException("Wrong input media type: {$data['type']}");
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

