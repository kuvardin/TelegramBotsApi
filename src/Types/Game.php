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
     * @var string $title Title of the game
     */
    public string $title;

    /**
     * @var string $description Description of the game
     */
    public string $description;

    /**
     * @var PhotoSize[] $photo Photo that will be displayed in the game message in chats.
     */
    public array $photo;

    /**
     * @var string|null $text Brief description of the game or high scores included in the game message. Can be
     *     automatically edited to include current high scores for the game when the bot calls <a
     *     href="https://core.telegram.org/bots/api#setgamescore">setGameScore</a>, or manually edited using <a
     *     href="https://core.telegram.org/bots/api#editmessagetext">editMessageText</a>. 0-4096 characters.
     */
    public ?string $text = null;

    /**
     * @var MessageEntity[]|null $text_entities Special entities that appear in <em>text</em>, such as usernames, URLs,
     *     bot commands, etc.
     */
    public ?array $text_entities = null;

    /**
     * @var Animation|null $animation Animation that will be displayed in the game message in chats. Upload via <a
     *     href="https://t.me/botfather">BotFather</a>
     */
    public ?Animation $animation = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->title = $data['title'];
        $result->description = $data['description'];
        $result->photo = [];
        foreach ($data['photo'] as $item_data) {
            $result->photo[] = PhotoSize::makeByArray($item_data);
        }
        $result->text = $data['text'] ?? null;
        if (isset($data['text_entities'])) {
            $result->text_entities = [];
            foreach ($data['text_entities'] as $item_data) {
                $result->text_entities[] = MessageEntity::makeByArray($item_data);
            }
        }
        $result->animation = isset($data['animation'])
            ? Animation::makeByArray($data['animation'])
            : null;
        return $result;
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
