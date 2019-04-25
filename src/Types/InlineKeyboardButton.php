<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents one button of an inline keyboard. You must use exactly one of the optional fields.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class InlineKeyboardButton implements TypeInterface
{
    /**
     * @var string Label text on the button
     */
    public $text;

    /**
     * @var string|null HTTP or tg:// url to be opened when button is pressed
     */
    public $url;

    /**
     * @var string|null Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
     */
    public $callback_data;

    /**
     * @var string|null If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot‘s username and the specified inline query in the input field. Can be empty, in which case just the bot’s username will be inserted.
     */
    public $switch_inline_query;

    /**
     * @var string|null If set, pressing the button will insert the bot‘s username and the specified inline query in the current chat's input field. Can be empty, in which case only the bot’s username will be inserted. This offers a quick way for the user to open your bot in inline mode in the same chat – good for selecting something from multiple options.
     */
    public $switch_inline_query_current_chat;

    /**
     * @var CallbackGame|null Description of the game that will be launched when the user presses the button
     */
    public $callback_game;

    /**
     * @var bool|null Specify True, to send a Pay button. NOTE: This type of button must always be the first button in the first row.
     */
    public $pay;

    /**
     * InlineKeyboardButton constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->text = $data['text'];
        $this->url = $data['url'] ?? null;
        $this->callback_data = $data['callback_data'] ?? null;
        $this->switch_inline_query = $data['switch_inline_query'] ?? null;
        $this->switch_inline_query_current_chat = $data['switch_inline_query_current_chat'] ?? null;
        $this->callback_game = isset($data['callback_game']) ? new CallbackGame($data['callback_game']) : null;
        $this->pay = $data['pay'] ?? null;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'text' => $this->text,
            'url' => $this->url,
            'callback_data' => $this->callback_data,
            'switch_inline_query' => $this->switch_inline_query,
            'switch_inline_query_current_chat' => $this->switch_inline_query_current_chat,
            'callback_game' => $this->callback_game,
            'pay' => $this->pay,
        ];
    }

    /**
     * @param string $text
     * @param string $url
     * @return InlineKeyboardButton
     */
    public static function makeWithUrl(string $text, string $url): self
    {
        return new self([
            'text' => $text,
            'url' => $url,
        ]);
    }

    /**
     * @param string $text
     * @param string $callback_data
     * @return InlineKeyboardButton
     */
    public static function makeWithCallbackData(string $text, string $callback_data): self
    {
        return new self([
            'text' => $text,
            'callback_data' => $callback_data,
        ]);
    }

    /**
     * @param string $text
     * @param string $switch_inline_query
     * @return InlineKeyboardButton
     */
    public static function makeWithSwitchInlineQuery(string $text, string $switch_inline_query): self
    {
        return new self([
            'text' => $text,
            'switch_inline_query' => $switch_inline_query,
        ]);
    }

    /**
     * @param string $text
     * @param string $switch_inline_query_current_chat
     * @return InlineKeyboardButton
     */
    public static function makeWithSwitchInlineQueryCurrentChat(string $text, string $switch_inline_query_current_chat): self
    {
        return new self([
            'text' => $text,
            'switch_inline_query_current_chat' => $switch_inline_query_current_chat,
        ]);
    }

    /**
     * @param string $text
     * @param string $callback_game
     * @return InlineKeyboardButton
     */
    public static function makeWithCallbackGame(string $text, string $callback_game): self
    {
        return new self([
            'text' => $text,
            'callback_game' => $callback_game,
        ]);
    }

    /**
     * @param string $text
     * @param string $pay
     * @return InlineKeyboardButton
     */
    public static function makeWithPay(string $text, string $pay): self
    {
        return new self([
            'text' => $text,
            'pay' => $pay,
        ]);
    }
}