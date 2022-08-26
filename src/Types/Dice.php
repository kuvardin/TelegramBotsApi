<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\DiceType;
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
     * @param string $emoji Emoji on which the dice throw animation is based
     * @param int $value Value of the dice, 1-6 for Dice, Darts and Bowling base emoji,
     *      1-5 for Basketball and Soccer base emoji, 1-64 for SlotMachine base emoji
     */
    public function __construct(
        public string $emoji,
        public int $value,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            emoji: $data['emoji'],
            value: $data['value'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'emoji' => $this->emoji,
            'value' => $this->value,
        ];
    }

    /**
     * @return DiceType|null Returns <em>Null</em> if the dice emoji is unknown.
     */
    public function getType(): ?DiceType
    {
        return DiceType::tryFromEmoji($this->emoji);
    }
}
