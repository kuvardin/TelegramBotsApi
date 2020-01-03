<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * This object represents a game. Use BotFather to create and edit games, their short names will act
 * as unique identifiers.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Game implements TypeInterface
{
    /**
     * @var string Title of the game
     */
    public string $title;

    /**
     * @var string Description of the game
     */
    public string $description;

    /**
     * @var PhotoSize[] Photo that will be displayed in the game message in chats.
     */
    public array $photo = [];

    /**
     * @var string|null Brief description of the game or high scores included in the game message.
     * Can be automatically edited to include current high scores for the game when the bot calls setGameScore,
     * or manually edited using editMessageText. 0-4096 characters.
     */
    public ?string $text;

    /**
     * @var MessageEntity[]|null Special entities that appear in text, such as usernames, URLs, bot commands, etc.
     */
    public ?array $text_entities;

    /**
     * @var Animation|null Animation that will be displayed in the game message in chats. Upload via BotFather
     */
    public ?Animation $animation;

    /**
     * Game constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->description = $data['description'];

        foreach ($data['photo'] as $item) {
            $this->photo[] = $item instanceof PhotoSize ? $item : new PhotoSize($item);
        }
        if (isset($data['text'])) {
            $this->text = $data['text'];
        }

        if (isset($data['text_entities'])) {
            foreach ($data['text_entities'] as $item) {
                $this->text_entities[] = $item instanceof MessageEntity ? $item : new MessageEntity($item);
            }
        }

        if (isset($data['animation'])) {
            $this->animation = $data['animation'] instanceof Animation
                ? $data['animation']
                : new Animation($data['animation']);
        }
    }

    /**
     * @param string $title Title of the game
     * @param string $description Description of the game
     * @param PhotoSize[] $photo Photo that will be displayed in the game message in chats.
     * @return Game
     * @throws Error
     */
    public static function make(string $title, string $description, array $photo): self
    {
        return new self([
            'title' => $title,
            'description' => $description,
            'photo' => $photo,
        ]);
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
}