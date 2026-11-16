<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object represents a block in a rich formatted message to be sent.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class InputRichBlock extends Type
{
    abstract public static function getType(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['type']) {
            InputRichBlock\Anchor::getType() => InputRichBlock\Anchor::makeByArray($data),
            InputRichBlock\Animation::getType() => InputRichBlock\Animation::makeByArray($data),
            InputRichBlock\Audio::getType() => InputRichBlock\Audio::makeByArray($data),
            InputRichBlock\BlockQuotation::getType() => InputRichBlock\BlockQuotation::makeByArray($data),
            InputRichBlock\Buttons::getType() => InputRichBlock\Buttons::makeByArray($data),
            InputRichBlock\Collage::getType() => InputRichBlock\Collage::makeByArray($data),
            InputRichBlock\Details::getType() => InputRichBlock\Details::makeByArray($data),
            InputRichBlock\Divider::getType() => InputRichBlock\Divider::makeByArray($data),
            InputRichBlock\Document::getType() => InputRichBlock\Document::makeByArray($data),
            InputRichBlock\ExpandableBlockQuotation::getType() => InputRichBlock\ExpandableBlockQuotation::makeByArray($data),
            InputRichBlock\Footer::getType() => InputRichBlock\Footer::makeByArray($data),
            InputRichBlock\ListItems::getType() => InputRichBlock\ListItems::makeByArray($data),
            InputRichBlock\Map::getType() => InputRichBlock\Map::makeByArray($data),
            InputRichBlock\MathematicalExpression::getType() => InputRichBlock\MathematicalExpression::makeByArray($data),
            InputRichBlock\Paragraph::getType() => InputRichBlock\Paragraph::makeByArray($data),
            InputRichBlock\Photo::getType() => InputRichBlock\Photo::makeByArray($data),
            InputRichBlock\Preformatted::getType() => InputRichBlock\Preformatted::makeByArray($data),
            InputRichBlock\PullQuotation::getType() => InputRichBlock\PullQuotation::makeByArray($data),
            InputRichBlock\SectionHeading::getType() => InputRichBlock\SectionHeading::makeByArray($data),
            InputRichBlock\Slideshow::getType() => InputRichBlock\Slideshow::makeByArray($data),
            InputRichBlock\Table::getType() => InputRichBlock\Table::makeByArray($data),
            InputRichBlock\Thinking::getType() => InputRichBlock\Thinking::makeByArray($data),
            InputRichBlock\Video::getType() => InputRichBlock\Video::makeByArray($data),
            InputRichBlock\VoiceNote::getType() => InputRichBlock\VoiceNote::makeByArray($data),
            default => throw new RuntimeException("Unknown input rich block type: {$data['type']}"),
        };
    }

    abstract public function getRequestData(): array;
}





