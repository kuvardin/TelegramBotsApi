<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about the color scheme for a user's name, message replies and link previews based
 * on a unique gift.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UniqueGiftColors extends Type
{
    /**
     * @param string $model_custom_emoji_id Custom emoji identifier of the unique gift's model
     * @param string $symbol_custom_emoji_id Custom emoji identifier of the unique gift's symbol
     * @param int $light_theme_main_color Main color used in light themes; RGB format
     * @param int[] $light_theme_other_colors List of 1-3 additional colors used in light themes; RGB format
     * @param int $dark_theme_main_color Main color used in dark themes; RGB format
     * @param int[] $dark_theme_other_colors List of 1-3 additional colors used in dark themes; RGB format
     */
    public function __construct(
        public string $model_custom_emoji_id,
        public string $symbol_custom_emoji_id,
        public int $light_theme_main_color,
        public array $light_theme_other_colors,
        public int $dark_theme_main_color,
        public array $dark_theme_other_colors,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            model_custom_emoji_id: $data['model_custom_emoji_id'],
            symbol_custom_emoji_id: $data['symbol_custom_emoji_id'],
            light_theme_main_color: $data['light_theme_main_color'],
            light_theme_other_colors: $data['light_theme_other_colors'],
            dark_theme_main_color: $data['dark_theme_main_color'],
            dark_theme_other_colors: $data['dark_theme_other_colors'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'model_custom_emoji_id' => $this->model_custom_emoji_id,
            'symbol_custom_emoji_id' => $this->symbol_custom_emoji_id,
            'light_theme_main_color' => $this->light_theme_main_color,
            'light_theme_other_colors' => $this->light_theme_other_colors,
            'dark_theme_main_color' => $this->dark_theme_main_color,
            'dark_theme_other_colors' => $this->dark_theme_other_colors,
        ];
    }
}
