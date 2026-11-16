<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * A link to a reference.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ReferenceLink extends RichTextModel
{
    /**
     * @param RichText $text The link text
     * @param string $reference_name The name of the reference
     */
    public function __construct(
        public RichText $text,
        public string $reference_name,
    )
    {

    }

    public static function getType(): string
    {
        return 'reference_link';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
            reference_name: $data['reference_name'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'reference_name' => $this->reference_name,
        ];
    }
}





