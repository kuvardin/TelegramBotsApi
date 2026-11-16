<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;

/**
 * A mathematical expression.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MathematicalExpression extends RichTextModel
{
    /**
     * @param string $expression The expression in LaTeX format
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
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
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

