<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichBlock;

use Kuvardin\TelegramBotsApi\Types\RichBlock;
use RuntimeException;

/**
 * A divider, corresponding to the HTML tag "&lt;hr/&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Divider extends RichBlock
{
    public function __construct()
    {

    }

    public static function getType(): string
    {
        return 'divider';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich block type: {$data['type']}");
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

