<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichBlock;

use Kuvardin\TelegramBotsApi\Types\RichBlock;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * A quotation with centered text, loosely corresponding to the HTML tag "&lt;aside&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PullQuotation extends RichBlock
{
    /**
     * @param RichText $text Text of the block
     * @param RichText|null $credit Credit of the block
     */
    public function __construct(
        public RichText $text,
        public ?RichText $credit = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'pullquote';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich block type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
            credit: isset($data['credit'])
                ? RichText::makeByInput($data['credit'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'credit' => $this->credit,
        ];
    }
}

