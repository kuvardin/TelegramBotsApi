<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\RichText;
use RuntimeException;

/**
 * A preformatted text block, corresponding to the nested HTML tags "&lt;pre&gt;" and "&lt;code&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Preformatted extends InputRichBlock
{
    /**
     * @param RichText $text Text of the block
     * @param string|null $language The programming language of the text
     */
    public function __construct(
        public RichText $text,
        public ?string $language = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'pre';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
            language: $data['language'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'language' => $this->language,
        ];
    }
}





