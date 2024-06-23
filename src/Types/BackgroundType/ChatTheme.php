<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\BackgroundType;

use Kuvardin\TelegramBotsApi\Types\BackgroundType;
use RuntimeException;

/**
 * The background is taken directly from a built-in chat theme.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ChatTheme extends BackgroundType
{
    /**
     * @param string $theme_name Name of the chat theme, which is usually an emoji
     */
    public function __construct(
        public string $theme_name,
    )
    {

    }

    public static function getType(): string
    {
        return 'chat_theme';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong chat theme type: {$data['type']}");
        }

        return new self(
            theme_name: $data['theme_name'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'theme_name' => $this->theme_name,
        ];
    }
}
