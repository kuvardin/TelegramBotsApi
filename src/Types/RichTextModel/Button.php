<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichMessageButton;
use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;

/**
 * A button.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Button extends RichTextModel
{
    /**
     * @param RichMessageButton $button The button
     */
    public function __construct(
        public RichMessageButton $button,
    )
    {

    }

    public static function getType(): string
    {
        return 'button';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
        }

        return new self(
            button: RichMessageButton::makeByArray($data['button']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'button' => $this->button,
        ];
    }
}

