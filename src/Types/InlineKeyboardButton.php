<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object represents one button of an inline keyboard. You must use exactly one of the optional fields.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InlineKeyboardButton implements TypeInterface
{
    /**
     * @var string Label text on the button
     */
    public string $text;

    /**
     * @var string|null HTTP or tg:// url to be opened when button is pressed
     */
    public ?string $url = null;

    /**
     * @var LoginUrl|null An HTTP URL used to automatically authorize the user. Can be used as a replacement
     * for the Telegram Login Widget.
     */
    public ?LoginUrl $login_url = null;

    /**
     * @var string|null Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
     */
    public ?string $callback_data = null;

    /**
     * @var string|null If set, pressing the button will prompt the user to select one of their chats, open that
     * chat and insert the bot‘s username and the specified inline query in the input field. Can be empty,
     * in which case just the bot’s username will be inserted.Note: This offers an easy way for users to start
     * using your bot in inline mode when they are currently in a private chat with it. Especially useful when
     * combined with switch_pm… actions – in this case the user will be automatically returned to the chat they
     * switched from, skipping the chat selection screen.
     */
    public ?string $switch_inline_query = null;

    /**
     * @var string|null If set, pressing the button will insert the bot‘s username and the specified inline query in the current chat's input field. Can be empty, in which case only the bot’s username will be inserted.This offers a quick way for the user to open your bot in inline mode in the same chat – good for selecting something from multiple options.
     */
    public ?string $switch_inline_query_current_chat = null;

    /**
     * @var CallbackGame|null Description of the game that will be launched when the user presses the button
     * .NOTE: This type of button must always be the first button in the first row.
     */
    public ?CallbackGame $callback_game = null;

    /**
     * @var bool|null Specify True, to send a Pay button.NOTE: This type of button must always be the first
     * button in the first row.
     */
    public ?bool $pay = null;

    /**
     * InlineKeyboardButton constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->text = $data['text'];

        if (isset($data['url'])) {
            $this->url = $data['url'];
        }

        if (isset($data['login_url'])) {
            $this->login_url = $data['login_url'] instanceof LoginUrl
                ? $data['login_url']
                : new LoginUrl($data['login_url']);
        }

        if (isset($data['callback_data'])) {
            $this->callback_data = $data['callback_data'];
        }

        if (isset($data['switch_inline_query'])) {
            $this->switch_inline_query = $data['switch_inline_query'];
        }

        if (isset($data['switch_inline_query_current_chat'])) {
            $this->switch_inline_query_current_chat = $data['switch_inline_query_current_chat'];
        }

        if (isset($data['callback_game'])) {
            $this->callback_game = $data['callback_game'] instanceof CallbackGame
                ? $data['callback_game']
                : new CallbackGame($data['callback_game']);
        }

        if (isset($data['pay'])) {
            $this->pay = $data['pay'];
        }
    }

    /**
     * @param string $text
     * @param string $url
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
     */
    public static function makeWithPay(string $text, string $pay): self
    {
        return new self([
            'text' => $text,
            'pay' => $pay,
        ]);
    }

    /**
     * @param string $text
     * @param LoginUrl $login_url
     * @return static
     */
    public static function makeWithLoginUrl(string $text, LoginUrl $login_url): self
    {
        return new self([
            'text' => $text,
            'login_url' => $login_url,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'text' => $this->text,
            'url' => $this->url,
            'login_url' => $this->login_url,
            'callback_data' => $this->callback_data,
            'switch_inline_query' => $this->switch_inline_query,
            'switch_inline_query_current_chat' => $this->switch_inline_query_current_chat,
            'callback_game' => $this->callback_game,
            'pay' => $this->pay,
        ];
    }
}
