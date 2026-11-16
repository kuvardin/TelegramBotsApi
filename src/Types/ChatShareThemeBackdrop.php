<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes a backdrop, which can be used as the background of a theme of the screen for sharing a link to
 * a user or a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatShareThemeBackdrop extends Type
{
    /**
     * @param int $id Unique identifier of the backdrop
     * @param string $name Name of the backdrop
     * @param UniqueGiftBackdropColors $colors Colors of the backdrop
     */
    public function __construct(
        public int $id,
        public string $name,
        public UniqueGiftBackdropColors $colors,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            colors: UniqueGiftBackdropColors::makeByArray($data['colors']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'colors' => $this->colors,
        ];
    }
}
