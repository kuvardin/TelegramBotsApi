<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * A text covered by a spoiler.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Spoiler extends RichTextModel
{
    /**
     * @param RichText $text The text
     */
    public function __construct(
        public RichText $text,
    )
    {

    }

    public static function getType(): string
    {
        return 'spoiler';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
        ];
    }
}

