<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;

/**
 * An anchor.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Anchor extends RichTextModel
{
    /**
     * @param string $name The name of the anchor
     */
    public function __construct(
        public string $name,
    )
    {

    }

    public static function getType(): string
    {
        return 'anchor';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
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

