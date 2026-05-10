<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMedia;

use Kuvardin\TelegramBotsApi\Types\InputFile;
use Kuvardin\TelegramBotsApi\Types\InputMedia;
use Kuvardin\TelegramBotsApi\Types\InputPollMedia;
use Kuvardin\TelegramBotsApi\Types\InputPollOptionMedia;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;
use RuntimeException;

/**
 * Represents a live photo to be sent.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class LivePhoto extends InputMedia implements InputPollMedia, InputPollOptionMedia
{
    /**
     * @param string $media Video of the live photo to send. Sending live photos by a URL is currently unsupported.
     * @param InputFile|string $photo The static photo to send. Sending live photos by a URL is currently unsupported.
     * @param string|null $caption Caption of the live photo to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Mode for parsing entities in the live photo caption. See formatting options for
     *     more details.
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption, which can be
     *     specified instead of "parse_mode"
     * @param bool|null $show_caption_above_media Pass True, if the caption must be shown above the message media
     * @param bool|null $has_spoiler Pass True if the live photo needs to be covered with a spoiler animation
     */
    public function __construct(
        public string $media,
        public InputFile|string $photo,
        public ?string $caption = null,
        public ?string $parse_mode = null,
        public ?array $caption_entities = null,
        public ?bool $show_caption_above_media = null,
        public ?bool $has_spoiler = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'live_photo';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input media type: {$data['type']}");
        }

        return new self(
            media: $data['media'],
            photo: $data['photo'],
            caption: $data['caption'] ?? null,
            parse_mode: $data['parse_mode'] ?? null,
            caption_entities: isset($data['caption_entities'])
                ? array_map(
                    static fn(array $caption_entities_data) => MessageEntity::makeByArray($caption_entities_data),
                    $data['caption_entities'],
                )
                : null,
            show_caption_above_media: $data['show_caption_above_media'] ?? null,
            has_spoiler: $data['has_spoiler'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'media' => $this->media,
            'photo' => $this->photo,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'caption_entities' => $this->caption_entities,
            'show_caption_above_media' => $this->show_caption_above_media,
            'has_spoiler' => $this->has_spoiler,
        ];
    }
}





