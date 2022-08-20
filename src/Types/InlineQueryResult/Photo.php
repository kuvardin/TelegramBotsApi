<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InlineQueryResult;

use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;
use Kuvardin\TelegramBotsApi\Types\InlineQueryResult;
use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;
use RuntimeException;

/**
 * Represents a link to a photo. By default, this photo will be sent by the user with optional caption. Alternatively,
 * you can use <em>input_message_content</em> to send a message with the specified content instead of the photo.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Photo extends InlineQueryResult
{
    /**
     * @var string $id Unique identifier for this result, 1-64 bytes
     */
    public string $id;

    /**
     * @var string $photo_url A valid URL of the photo. Photo must be in <strong>JPEG</strong> format. Photo size must
     *     not exceed 5MB
     */
    public string $photo_url;

    /**
     * @var string $thumb_url URL of the thumbnail for the photo
     */
    public string $thumb_url;

    /**
     * @var int|null $photo_width Width of the photo
     */
    public ?int $photo_width = null;

    /**
     * @var int|null $photo_height Height of the photo
     */
    public ?int $photo_height = null;

    /**
     * @var string|null $title Title for the result
     */
    public ?string $title = null;

    /**
     * @var string|null $description Short description of the result
     */
    public ?string $description = null;

    /**
     * @var string|null $caption Caption of the photo to be sent, 0-1024 characters after entities parsing
     */
    public ?string $caption = null;

    /**
     * @var string|null $parse_mode Mode for parsing entities in the photo caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     */
    public ?string $parse_mode = null;

    /**
     * @var MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of <em>parse_mode</em>
     */
    public ?array $caption_entities = null;

    /**
     * @var InlineKeyboardMarkup|null $reply_markup <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">Inline keyboard</a> attached
     *     to the message
     */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /**
     * @var InputMessageContent|null $input_message_content Content of the message to be sent instead of the photo
     */
    public ?InputMessageContent $input_message_content = null;

    public static function getType(): string
    {
        return 'photo';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong inline query result type: {$data['type']}");
        }

        $result->id = $data['id'];
        $result->photo_url = $data['photo_url'];
        $result->thumb_url = $data['thumb_url'];
        $result->photo_width = $data['photo_width'] ?? null;
        $result->photo_height = $data['photo_height'] ?? null;
        $result->title = $data['title'] ?? null;
        $result->description = $data['description'] ?? null;
        $result->caption = $data['caption'] ?? null;
        $result->parse_mode = $data['parse_mode'] ?? null;
        if (isset($data['caption_entities'])) {
            $result->caption_entities = [];
            foreach ($data['caption_entities'] as $item_data) {
                $result->caption_entities[] = MessageEntity::makeByArray($item_data);
            }
        }
        $result->reply_markup = isset($data['reply_markup'])
            ? InlineKeyboardMarkup::makeByArray($data['reply_markup'])
            : null;
        $result->input_message_content = isset($data['input_message_content'])
            ? InputMessageContent::makeByArray($data['input_message_content'])
            : null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'id' => $this->id,
            'photo_url' => $this->photo_url,
            'thumb_url' => $this->thumb_url,
            'photo_width' => $this->photo_width,
            'photo_height' => $this->photo_height,
            'title' => $this->title,
            'description' => $this->description,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'reply_markup' => $this->reply_markup,
            'input_message_content' => $this->input_message_content,
        ];
    }
}
