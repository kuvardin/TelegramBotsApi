<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * A link to an anchor.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class AnchorLink extends RichTextModel
{
    /**
     * @param RichText $text The link text
     * @param string $anchor_name The name of the anchor. If the name is empty, then the link brings back to the top of
     *     the message.
     */
    public function __construct(
        public RichText $text,
        public string $anchor_name,
    )
    {

    }

    public static function getType(): string
    {
        return 'anchor_link';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
            anchor_name: $data['anchor_name'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'anchor_name' => $this->anchor_name,
        ];
    }
}





