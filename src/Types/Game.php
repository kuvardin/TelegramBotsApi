<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * This object represents a game. Use BotFather to create and edit games, their short names will act as unique identifiers.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Game implements TypeInterface
{

    /**
     * @var string Title of the game
     */
    public $title;

    /**
     * @var string Description of the game
     */
    public $description;

    /**
     * @var PhotoSize[] Photo that will be displayed in the game message in chats.
     */
    public $photo;

    /**
     * @var string|null Brief description of the game or high scores included in the game message. Can be automatically edited to include current high scores for the game when the bot calls setGameScore, or manually edited using editMessageText. 0-4096 characters.
     */
    public $text;

    /**
     * @var MessageEntity[]|null Special entities that appear in text, such as usernames, URLs, bot commands, etc.
     */
    public $text_entities;

    /**
     * @var Animation|null Animation that will be displayed in the game message in chats. Upload via BotFather
     */
    public $animation;

    /**
     * Game constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->description = $data['description'];

        $this->photo = [];
        foreach ($data['photo'] as $photo) {
            $this->photo[] = $photo instanceof PhotoSize ? $photo : new PhotoSize($photo);
        }

        $this->text = $data['text'] ?? null;

        $this->text_entities = [];
        foreach ($data['text_entities'] as $text_entity) {
            $this->text_entities[] = $data['text_entities'] instanceof MessageEntity ? $data['text_entities'] : new MessageEntity($data['text_entities']);
        }

        if (isset($data['animation'])) {
            $this->animation = $data['animation'] instanceof Animation ? $data['animation'] : new Animation($data['animation']);
        }
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
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

    /**
     * @param string $title
     * @param string $description
     * @param array $photo
     * @return Game
     */
    public static function make(string $title, string $description, array $photo): self
    {
        return new self([
            'title' => $title,
            'description' => $description,
            'photo' => $photo,
        ]);
    }
}