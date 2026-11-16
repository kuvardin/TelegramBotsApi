<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\InputMedia\Document as InputMediaDocument;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;
use RuntimeException;

/**
 * A block with a general file, corresponding to the custom HTML tag "&lt;tg-document&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Document extends InputRichBlock
{
    /**
     * @param InputMediaDocument $document The document. Caption is ignored.
     * @param RichBlockCaption|null $caption Caption of the block
     */
    public function __construct(
        public InputMediaDocument $document,
        public ?RichBlockCaption $caption = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'document';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            document: InputMediaDocument::makeByArray($data['document']),
            caption: isset($data['caption'])
                ? RichBlockCaption::makeByArray($data['caption'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'document' => $this->document,
            'caption' => $this->caption,
        ];
    }
}





