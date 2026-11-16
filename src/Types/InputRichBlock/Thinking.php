<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\RichText;
use RuntimeException;

/**
 * A block with a “Thinking…” placeholder, corresponding to the custom HTML tag "&lt;tg-thinking&gt;". The block may be
 * used only in sendRichMessageDraft(), therefore it can't be received in messages. See <a
 * href="https://t.me/addemoji/AIActions">https://t.me/addemoji/AIActions</a> for examples of custom emoji that are
 * recommended for usage in the block.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Thinking extends InputRichBlock
{
    /**
     * @param RichText $text Text of the block. See <a
     *     href="https://t.me/addemoji/AIActions">https://t.me/addemoji/AIActions</a> for examples of custom emoji that
     *     are recommended for usage in the block.
     */
    public function __construct(
        public RichText $text,
    )
    {

    }

    public static function getType(): string
    {
        return 'thinking';
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

