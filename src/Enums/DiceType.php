<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

/**
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
enum DiceType: string
{
    case Dice = 'dice';
    case Darts = 'darts';
    case Basketball = 'basketball';
    case Soccer = 'soccer';
    case Bowling = 'bowling';
    case SlotMachine = 'slot_machine';

    public static function tryFromEmoji(string $emoji): ?self
    {
        return match ($emoji) {
            "\u{1F3B2}" => self::Dice,
            "\u{1F3AF}" => self::Darts,
            "\u{1F3C0}" => self::Basketball,
            "\u{26BD}" => self::Soccer,
            "\u{1F3B3}" => self::Bowling,
            "\u{1F3B0}" => self::SlotMachine,
        };
    }

    public function getEmoji(): string
    {
        return match ($this) {
            self::Dice => "\u{1F3B2}",
            self::Darts => "\u{1F3AF}",
            self::Basketball => "\u{1F3C0}",
            self::Soccer => "\u{26BD}",
            self::Bowling => "\u{1F3B3}",
            self::SlotMachine => "\u{1F3B0}",
        };
    }
}