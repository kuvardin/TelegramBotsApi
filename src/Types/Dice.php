<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an animated emoji that displays a random value.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Dice extends Type
{
    /**
     * @var string $emoji Emoji on which the dice throw animation is based
     */
    public string $emoji;

    /**
     * @var int $value Value of the dice, 1-6 for “<img class="emoji"
     *     src="https://telegram.org/img/emoji/40/F09F8EB2.png" width="20" height="20" alt="🎲" />”, “<img
     *     class="emoji" src="https://telegram.org/img/emoji/40/F09F8EAF.png" width="20" height="20" alt="🎯" />” and
     *     “<img class="emoji" src="https://telegram.org/img/emoji/40/F09F8EB3.png" width="20" height="20" alt="🎳" />”
     *     base emoji, 1-5 for “<img class="emoji" src="https://telegram.org/img/emoji/40/F09F8F80.png" width="20"
     *     height="20" alt="🏀" />” and “<img class="emoji" src="https://telegram.org/img/emoji/40/E29ABD.png"
     *     width="20" height="20" alt="⚽" />” base emoji, 1-64 for “<img class="emoji"
     *     src="https://telegram.org/img/emoji/40/F09F8EB0.png" width="20" height="20" alt="🎰" />” base emoji
     */
    public int $value;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->emoji = $data['emoji'];
        $result->value = $data['value'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'emoji' => $this->emoji,
            'value' => $this->value,
        ];
    }
}
