<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains a list of backdrops, which can be used as the background of a theme of the screen for sharing a
 * link to a user or a chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatShareThemeBackdrops extends Type
{
    /**
     * @param ChatShareThemeBackdrop[] $backdrops The list of backdrops
     */
    public function __construct(
        public array $backdrops,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            backdrops: array_map(
                static fn(array $backdrops_data) => ChatShareThemeBackdrop::makeByArray($backdrops_data),
                $data['backdrops'],
            ),
        );
    }

    public function getRequestData(): array
    {
        return [
            'backdrops' => $this->backdrops,
        ];
    }
}
