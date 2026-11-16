<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\RichText;
use RuntimeException;

/**
 * A section heading, corresponding to the HTML tags "&lt;h1&gt;", "&lt;h2&gt;", "&lt;h3&gt;", "&lt;h4&gt;",
 * "&lt;h5&gt;", or "&lt;h6&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SectionHeading extends InputRichBlock
{
    /**
     * @param RichText $text Text of the block
     * @param int $size Relative size of the text font; 1-6, 1 is the largest, 6 is the smallest
     */
    public function __construct(
        public RichText $text,
        public int $size,
    )
    {

    }

    public static function getType(): string
    {
        return 'heading';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
            size: $data['size'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'size' => $this->size,
        ];
    }
}

