<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichBlock;

use Kuvardin\TelegramBotsApi\Enums\HorizontalAlignment;
use Kuvardin\TelegramBotsApi\Types\RichBlock;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichMessageButton;

/**
 * A block containing a list of buttons that are shown in one row, corresponding to the custom HTML tag
 * "&lt;tg-button-row&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Buttons extends RichBlock
{
    /**
     * @param RichMessageButton[] $buttons The buttons
     * @param string|null $align_value Horizontal alignment of the buttons. Currently, must be one of “left”, “center”,
     *     or “right”.
     */
    public function __construct(
        public array $buttons,
        public ?string $align_value = null,
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
            throw new RuntimeException("Wrong rich block type: {$data['type']}");
        }

        return new self(
            buttons: array_map(
                static fn(array $buttons_data) => RichMessageButton::makeByArray($buttons_data),
                $data['buttons'],
            ),
            align_value: $data['align'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'buttons' => $this->buttons,
            'align' => $this->align_value,
        ];
    }

    public function getAlign(): ?HorizontalAlignment
    {
        return HorizontalAlignment::tryFrom($this->align_value);
    }
}





