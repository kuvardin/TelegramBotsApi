<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represent a list of gifts.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Gifts extends Type
{
    /**
     * @param Gift[] $gifts The list of gifts
     */
    public function __construct(
        public array $gifts,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            gifts: array_map(
				static fn(array $gifts_data) => Gift::makeByArray($gifts_data),
				$data['gifts'],
			),
        );
    }

    public function getRequestData(): array
    {
        return [
            'gifts' => $this->gifts,
        ];
    }
}
