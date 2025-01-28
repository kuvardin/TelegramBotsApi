<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an inline keyboard button that copies specified text to the clipboard.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CopyTextButton extends Type
{
    /**
     * @param string $text The text to be copied to the clipboard; 1-256 characters
     */
    public function __construct(
        public string $text,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            text: $data['text'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'text' => $this->text,
        ];
    }
}
