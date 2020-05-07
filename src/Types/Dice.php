<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * This object represents a dice with a random value from 1 to 6 for currently supported base emoji.
 * (Yes, we're aware of the “proper” singular of die. But it's awkward, and we decided to help it change.
 * One dice at a time!)
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Dice implements TypeInterface
{
    public const EMOJI_GAME_DIE = "\u{1F3B2}";
    public const EMOJI_DIRECT_HIT = "\u{1F3AF}";

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
     * @throws Error
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
     * @param string $emoji Emoji on which the dice throw animation is based
     * @param string $value Value of the dice, 1-6 for currently supported base emoji
     * @return static
     * @throws Error
     */
    public static function make(string $emoji, string $value): self
    {
        return new self([
            'emoji' => $emoji,
            'value' => $value,
        ]);
    }

    /**
     * @param string $emoji
     * @return bool
     */
    public static function checkEmoji(string $emoji): bool
    {
        return $emoji === self::EMOJI_DIRECT_HIT ||
            $emoji === self::EMOJI_GAME_DIE;
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
