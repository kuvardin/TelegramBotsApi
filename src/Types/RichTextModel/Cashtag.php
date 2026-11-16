<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * A cashtag.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Cashtag extends RichTextModel
{
    /**
     * @param RichText $text The text
     * @param string $cashtag The cashtag
     */
    public function __construct(
        public RichText $text,
        public string $cashtag,
    )
    {

    }

    public static function getType(): string
    {
        return 'cashtag';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
            cashtag: $data['cashtag'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'cashtag' => $this->cashtag,
        ];
    }
}

