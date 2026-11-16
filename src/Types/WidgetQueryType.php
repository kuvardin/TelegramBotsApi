<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object describes the type of a query from a widget
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class WidgetQueryType extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            WidgetQueryType\Data::getType() => WidgetQueryType\Data::makeByArray($data),
            WidgetQueryType\SentTransaction::getType() => WidgetQueryType\SentTransaction::makeByArray($data),
            WidgetQueryType\SignData::getType() => WidgetQueryType\SignData::makeByArray($data),
            default => throw new RuntimeException("Unknown widget query type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}





