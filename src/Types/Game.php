<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a game. Use BotFather to create and edit games, their short names will act as unique
 * identifiers.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Game extends Type
{
    /**
     * @param string $title Title of the game
     * @param string $description Description of the game
     * @param PhotoSize[] $photo Photo that will be displayed in the game message in chats.
     * @param string|null $text Brief description of the game or high scores included in the game message. Can be
     *     automatically edited to include current high scores for the game when the bot calls setGameScore(), or
     *     manually edited using editMessageText(). 0-4096 characters.
     * @param MessageEntity[]|null $text_entities Special entities that appear in "text", such as usernames, URLs, bot
     *     commands, etc.
     * @param Animation|null $animation Animation that will be displayed in the game message in chats. Upload via
     *     BotFather
     */
    public function __construct(
        public string $title,
        public string $description,
        public array $photo,
        public ?string $text = null,
        public ?array $text_entities = null,
        public ?Animation $animation = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            title: $data['title'],
            description: $data['description'],
            photo: array_map(
                static fn(array $photo_data) => PhotoSize::makeByArray($photo_data),
                $data['photo'],
            ),
            text: $data['text'] ?? null,
            text_entities: isset($data['text_entities'])
                ? array_map(
                    static fn(array $text_entities_data) => MessageEntity::makeByArray($text_entities_data),
                    $data['text_entities'],
                )
                : null,
            animation: isset($data['animation'])
                ? Animation::makeByArray($data['animation'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'photo' => $this->photo,
            'text' => $this->text,
            'text_entities' => $this->text_entities,
            'animation' => $this->animation,
        ];
    }
}
