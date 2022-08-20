<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Enums;

enum DiceEmoji: string
{
    case Dice = "\u{1F3B2}";
    case Darts = "\u{1F3AF}";
    case Basketball = "\u{1F3C0}";
    case Soccer = "\u{26BD}";
    case Bowling = "\u{1F3B3}";
    case SlotMachine = "\u{1F3B0}";
}