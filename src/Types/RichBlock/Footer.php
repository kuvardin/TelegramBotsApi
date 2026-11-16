<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichBlock;

use Kuvardin\TelegramBotsApi\Types\RichBlock;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * A footer, corresponding to the HTML tag "&lt;footer&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Footer extends RichBlock
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
            throw new RuntimeException("Wrong rich block type: {$data['type']}");
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

