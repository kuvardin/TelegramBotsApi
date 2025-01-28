<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ReactionType;

use Kuvardin\TelegramBotsApi\Types\ReactionType;
use RuntimeException;

/**
 * The reaction is paid.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Paid extends ReactionType
{
    public function __construct(

    )
    {

    }

    public static function getType(): string
    {
        return 'paid';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong reaction type: {$data['type']}");
        }

        return new self();
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
        ];
    }
}
