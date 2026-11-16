<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * A text with a link.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Url extends RichTextModel
{
    /**
     * @param RichText $text The text
     * @param string $url URL of the link
     */
    public function __construct(
        public RichText $text,
        public string $url,
    )
    {

    }

    public static function getType(): string
    {
        return 'url';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
            url: $data['url'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'url' => $this->url,
        ];
    }
}

