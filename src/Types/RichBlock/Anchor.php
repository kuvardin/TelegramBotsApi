<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichBlock;

use Kuvardin\TelegramBotsApi\Types\RichBlock;
use RuntimeException;

/**
 * A block with an anchor, corresponding to the HTML tag "&lt;a&gt;" with the attribute "name".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Anchor extends RichBlock
{
    /**
     * @param string $name The name of the anchor
     */
    public function __construct(
        public string $name,
    )
    {

    }

    public static function getType(): string
    {
        return 'anchor';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich block type: {$data['type']}");
        }

        return new self(
            name: $data['name'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'name' => $this->name,
        ];
    }
}





