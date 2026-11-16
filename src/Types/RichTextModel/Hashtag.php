<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * A hashtag.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Hashtag extends RichTextModel
{
    /**
     * @param RichText $text The text
     * @param string $hashtag The hashtag
     */
    public function __construct(
        public RichText $text,
        public string $hashtag,
    )
    {

    }

    public static function getType(): string
    {
        return 'hashtag';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
            hashtag: $data['hashtag'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'hashtag' => $this->hashtag,
        ];
    }
}

