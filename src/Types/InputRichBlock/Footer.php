<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\RichText;
use RuntimeException;

/**
 * A footer, corresponding to the HTML tag "&lt;footer&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Footer extends InputRichBlock
{
    /**
     * @param RichText $text Text of the block
     */
    public function __construct(
        public RichText $text,
    )
    {

    }

    public static function getType(): string
    {
        return 'footer';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
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

