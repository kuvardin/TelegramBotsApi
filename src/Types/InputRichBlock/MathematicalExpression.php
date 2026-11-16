<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use RuntimeException;

/**
 * A block with a mathematical expression in LaTeX format, corresponding to the custom HTML tag "&lt;tg-math-block&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MathematicalExpression extends InputRichBlock
{
    /**
     * @param string $expression The mathematical expression in LaTeX format
     */
    public function __construct(
        public string $expression,
    )
    {

    }

    public static function getType(): string
    {
        return 'mathematical_expression';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            expression: $data['expression'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'expression' => $this->expression,
        ];
    }
}

