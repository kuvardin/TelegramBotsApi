<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMedia;

use Kuvardin\TelegramBotsApi\Types\InputMedia;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;
use RuntimeException;

/**
 * Represents a photo to be sent.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Photo extends InputMedia
{
    /**
     * @var string $media File to send. Pass a file_id to send a file that exists on the Telegram servers
     *     (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass
     *     “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
     *     <a href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>
     */
    public string $media;

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

    public static function getType(): string
    {
        return 'photo';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input media type: {$data['type']}");
        }

        $result->media = $data['media'];
        $result->caption = $data['caption'] ?? null;
        $result->parse_mode = $data['parse_mode'] ?? null;
        if (isset($data['caption_entities'])) {
            $result->caption_entities = [];
            foreach ($data['caption_entities'] as $item_data) {
                $result->caption_entities[] = MessageEntity::makeByArray($item_data);
            }
        }
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'media' => $this->media,
            'caption' => $this->caption,
            'parse_mode' => $this->parse_mode,
            'caption_entities' => $this->caption_entities,
        ];
    }
}
