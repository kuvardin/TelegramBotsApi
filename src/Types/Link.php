<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Represents an HTTP link.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Link extends Type
{
    /**
     * @param string $url URL of the link
     */
    public function __construct(
        public string $url,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            url: $data['url'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'url' => $this->url,
        ];
    }
}

