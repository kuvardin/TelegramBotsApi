<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use RuntimeException;

/**
 * A divider, corresponding to the HTML tag "&lt;hr/&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Divider extends InputRichBlock
{
    public function __construct(

    )
    {

    }

    public static function getType(): string
    {
        return 'divider';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(

        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
        ];
    }
}

