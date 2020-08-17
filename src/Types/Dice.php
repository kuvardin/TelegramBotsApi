<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Exceptions\Error;

/**
 * This object represents a dice with a random value from 1 to 6 for currently supported base emoji.
 * (Yes, we're aware of the “proper” singular of die. But it's awkward, and we decided to help it change.
 * One dice at a time!)
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Dice implements TypeInterface
{
    public const EMOJI_DICE = "\u{1F3B2}";
    public const EMOJI_DARTS = "\u{1F3AF}";

    /**
     * @var string Emoji on which the dice throw animation is based. Must be self::EMOJI_*
     */
    public string $emoji;

    /**
     * @var int Value of the dice, 1-6 for currently supported base emoji
     */
    public int $value;

    /**
     * Dice constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (!self::checkEmoji($data['emoji'])) {
            throw new Error("Unknown dice emoji: {$data['emoji']}");
        }
        $this->emoji = $data['emoji'];
        $this->value = $data['value'];
    }

    /**
     * @param string $emoji
     * @return bool
     */
    public static function checkEmoji(string $emoji): bool
    {
        return $emoji === self::EMOJI_DICE || $emoji === self::EMOJI_DARTS;
    }

    /**
     * @param string $emoji Emoji on which the dice throw animation is based
     * @param string $value Value of the dice, 1-6 for currently supported base emoji
     * @return static
     */
    public static function make(string $emoji, string $value): self
    {
        return new self([
            'emoji' => $emoji,
            'value' => $value,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'emoji' => $this->emoji,
            'value' => $this->value,
        ];
    }
}
