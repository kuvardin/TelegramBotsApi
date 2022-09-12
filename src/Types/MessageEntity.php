<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use Kuvardin\TelegramBotsApi\Enums\MessageEntityType;

/**
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MessageEntity extends Type
{
    /**
     * @param string $type_value Type of the entity. Can be one of Enums\MessageEntityType.
     * @param int $offset Offset in UTF-16 code units to the start of the entity
     * @param int $length Length of the entity in UTF-16 code units
     * @param string|null $url For “text_link” only, url that will be opened after user taps on the text
     * @param User|null $user For “text_mention” only, the mentioned user
     * @param string|null $language For “pre” only, the programming language of the entity text
     * @param string|null $custom_emoji_id For “custom_emoji” only, unique identifier of the custom emoji.
     *     Use getCustomEmojiStickers() to get full information about the sticker
     */
    public function __construct(
        public string $type_value,
        public int $offset,
        public int $length,
        public ?string $url = null,
        public ?User $user = null,
        public ?string $language = null,
        public ?string $custom_emoji_id = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            type_value: $data['type'],
            offset: $data['offset'],
            length: $data['length'],
            url: $data['url'] ?? null,
            user: isset($data['user'])
                ? User::makeByArray($data['user'])
                : null,
            language: $data['language'] ?? null,
            custom_emoji_id: $data['custom_emoji_id'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => $this->type_value,
            'offset' => $this->offset,
            'length' => $this->length,
            'url' => $this->url,
            'user' => $this->user,
            'language' => $this->language,
            'custom_emoji_id' => $this->custom_emoji_id,
        ];
    }

    /**
     * @return MessageEntityType|null Returns <em>Null</em> if the message entity type value is unknown.
     */
    public function getType(): ?MessageEntityType
    {
        return MessageEntityType::tryFrom($this->type_value);
    }
}
