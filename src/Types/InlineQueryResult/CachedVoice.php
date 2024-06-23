<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;
use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;
use RuntimeException;

/**
 * Represents a link to a voice message stored on the Telegram servers. By default, this voice message will be sent by
 * the user. Alternatively, you can use "input_message_content" to send a message with the specified content instead of
 * the voice message.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CachedVoice extends InlineQueryResult
{
    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $voice_file_id A valid file identifier for the voice message
     * @param string $title Voice message title
     * @param string|null $caption Caption, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Mode for parsing entities in the voice message caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of "parse_mode"
     * @param InlineKeyboardMarkup|null $reply_markup Inline keyboard attached to the message
     * @param InputMessageContent|null $input_message_content Content of the message to be sent instead of the voice
     *     message
     */
    public function __construct(
        public string $id,
        public string $voice_file_id,
        public string $title,
        public ?string $caption = null,
        public ?string $parse_mode = null,
        public ?array $caption_entities = null,
        public ?InlineKeyboardMarkup $reply_markup = null,
        public ?InputMessageContent $input_message_content = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'voice';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        return new self(
            id: $data['id'],
            voice_file_id: $data['voice_file_id'],
            title: $data['title'],
            caption: $data['caption'] ?? null,
            parse_mode: $data['parse_mode'] ?? null,
            caption_entities: isset($data['caption_entities'])
                ? array_map(
                    static fn(array $caption_entities_data) => MessageEntity::makeByArray($caption_entities_data),
                    $data['caption_entities'],
                )
                : null,
            reply_markup: isset($data['reply_markup'])
                ? InlineKeyboardMarkup::makeByArray($data['reply_markup'])
                : null,
            input_message_content: isset($data['input_message_content'])
                ? InputMessageContent::makeByArray($data['input_message_content'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'id' => $this->id,
            'voice_file_id' => $this->voice_file_id,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }
}
