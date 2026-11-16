<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes a rich message to be sent. Exactly <strong>one</strong> of the fields "html", "markdown", or "blocks" must
 * be used.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InputRichMessage extends Type
{
    /**
     * @param InputRichBlock[]|null $blocks Content of the rich message to send described as a list of blocks
     * @param string|null $html Content of the rich message to send described using HTML formatting. See rich message
     *     formatting options for more details. Use "media" field to specify the media used in the message.
     * @param string|null $markdown Content of the rich message to send described using Markdown formatting. See rich
     *     message formatting options for more details. Use "media" field to specify the media used in the message.
     * @param InputRichMessageMedia[]|null $media List of media that are specified in the "markdown" or "html" fields
     *     using "tg://photo?id=", "tg://video?id=", "tg://document?id=", and "tg://audio?id=" links
     * @param bool|null $is_rtl Pass True if the rich message must be shown right-to-left
     * @param bool|null $skip_entity_detection Pass True to skip automatic detection of entities (e.g., URLs, email
     *     addresses, username mentions, hashtags, cashtags, bot commands, or phone numbers) in the text
     */
    public function __construct(
        public ?array $blocks = null,
        public ?string $html = null,
        public ?string $markdown = null,
        public ?array $media = null,
        public ?bool $is_rtl = null,
        public ?bool $skip_entity_detection = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            blocks: isset($data['blocks'])
                ? array_map(
                    static fn(array $blocks_data) => InputRichBlock::makeByArray($blocks_data),
                    $data['blocks'],
                )
                : null,
            html: $data['html'] ?? null,
            markdown: $data['markdown'] ?? null,
            media: isset($data['media'])
                ? array_map(
                    static fn(array $media_data) => InputRichMessageMedia::makeByArray($media_data),
                    $data['media'],
                )
                : null,
            is_rtl: $data['is_rtl'] ?? null,
            skip_entity_detection: $data['skip_entity_detection'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'blocks' => $this->blocks,
            'html' => $this->html,
            'markdown' => $this->markdown,
            'media' => $this->media,
            'is_rtl' => $this->is_rtl,
            'skip_entity_detection' => $this->skip_entity_detection,
        ];
    }
}

