<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ChatShareTheme;

use Kuvardin\TelegramBotsApi\Types\ChatShareTheme;
use Kuvardin\TelegramBotsApi\Types\UniqueGift as UniqueGiftType;
use RuntimeException;

/**
 * The theme based on a unique gift owned by the user or the chat.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UniqueGift extends ChatShareTheme
{
    /**
     * @param UniqueGiftType $gift The gift
     */
    public function __construct(
        public UniqueGiftType $gift,
    )
    {

    }

    public static function getType(): string
    {
        return 'unique_gift';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong chat share theme type: {$data['type']}");
        }

        return new self(
            gift: UniqueGiftType::makeByArray($data['gift']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'gift' => $this->gift,
        ];
    }
}

