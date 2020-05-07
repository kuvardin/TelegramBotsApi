<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types\InlineQueryResult;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;
use TelegramBotsApi\Types;
use TelegramBotsApi\Types\InlineQueryResult;

/**
 * Represents a Game.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Game extends InlineQueryResult implements TelegramBotsApi\Types\TypeInterface
{
    public const TYPE = InlineQueryResult::TYPE_GAME;

    /**
     * @var string Unique identifier for this result, 1-64 bytes
     */
    public string $id;

    /**
     * @var string Short name of the game
     */
    public string $game_short_name;

    /**
     * @var Types\InlineKeyboardMarkup|null Inline keyboard attached to the message
     */
    public ?Types\InlineKeyboardMarkup $reply_markup = null;

    /**
     * Game constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($data['type'] !== self::TYPE) {
            throw new Error("Unknown type: {$data['type']} (must be self::TYPE)");
        }

        $this->id = $data['id'];
        $this->game_short_name = $data['game_short_name'];

        if (isset($data['reply_markup'])) {
            $this->reply_markup = $data['reply_markup'] instanceof Types\InlineKeyboardMarkup
                ? $data['reply_markup']
                : new Types\InlineKeyboardMarkup($data['reply_markup']);
        }
    }

    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $game_short_name Short name of the game
     * @return self
     * @throws Error
     */
    public static function make(string $id, string $game_short_name): self
    {
        return new self([
            'type' => self::TYPE,
            'id' => $id,
            'game_short_name' => $game_short_name,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'type' => self::TYPE,
            'id' => $this->id,
            'game_short_name' => $this->game_short_name,
            'reply_markup' => $this->reply_markup,
        ];
    }
}
