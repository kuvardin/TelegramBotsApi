<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\RichMessageButton;
use RuntimeException;

/**
 * A block containing a list of buttons that are shown in one row, corresponding to the custom HTML tag
 * "&lt;tg-button-row&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Buttons extends InputRichBlock
{
    /**
     * @param RichMessageButton[] $buttons List of 1-8 buttons to send
     * @param string|null $align Horizontal alignment of the buttons. Currently, must be one of “left”, “center”, or
     *     “right”.
     */
    public function __construct(
        public array $buttons,
        public ?string $align = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'buttons';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            buttons: array_map(
                static fn(array $buttons_data) => RichMessageButton::makeByArray($buttons_data),
                $data['buttons'],
            ),
            align: $data['align'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'buttons' => $this->buttons,
            'align' => $this->align,
        ];
    }
}





