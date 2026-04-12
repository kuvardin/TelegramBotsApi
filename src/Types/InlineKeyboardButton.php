<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\KeyboardButtonStyle;
use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents one button of an inline keyboard. Exactly one of the fields other than "text",
 * "icon_custom_emoji_id", and "style" must be used to specify the type of the button.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InlineKeyboardButton extends Type
{
    /**
     * @param string $text Label text on the button
     * @param string|null $url HTTP or tg:// URL to be opened when the button is pressed. Links
     *     "tg://user?id=<user_id>" can be used to mention a user by their identifier without using a username, if this
     *     is allowed by their privacy settings.
     * @param string|null $callback_data Data to be sent in a callback query to the bot when the button is pressed,
     *     1-64 bytes
     * @param WebAppInfo|null $web_app Description of the Web App that will be launched when the user presses the
     *     button. The Web App will be able to send an arbitrary message on behalf of the user using the method
     *     answerWebAppQuery(). Available only in private chats between a user and the bot. Not supported for messages
     *     sent on behalf of a Telegram Business account.
     * @param LoginUrl|null $login_url An HTTPS URL used to automatically authorize the user. Can be used as a
     *     replacement for the Telegram Login Widget.
     * @param string|null $switch_inline_query If set, pressing the button will prompt the user to select one of their
     *     chats, open that chat and insert the bot's username and the specified inline query in the input field. May
     *     be empty, in which case just the bot's username will be inserted. Not supported for messages sent in channel
     *     direct messages chats and on behalf of a Telegram Business account.
     * @param string|null $switch_inline_query_current_chat If set, pressing the button will insert the bot's username
     *     and the specified inline query in the current chat's input field. May be empty, in which case only the bot's
     *     username will be inserted.<br><br>This offers a quick way for the user to open your bot in inline mode in
     *     the same chat - good for selecting something from multiple options. Not supported in channels and for
     *     messages sent in channel direct messages chats and on behalf of a Telegram Business account.
     * @param SwitchInlineQueryChosenChat|null $switch_inline_query_chosen_chat If set, pressing the button will prompt
     *     the user to select one of their chats of the specified type, open that chat and insert the bot's username
     *     and the specified inline query in the input field. Not supported for messages sent in channel direct
     *     messages chats and on behalf of a Telegram Business account.
     * @param CallbackGame|null $callback_game Description of the game that will be launched when the user presses the
     *     button.<br><br><strong>NOTE:</strong> This type of button <strong>must</strong> always be the first button
     *     in the first row.
     * @param bool|null $pay Specify True, to send a Pay button. Substrings ⭐ and “XTR” in the buttons's text will be
     *     replaced with a Telegram Star icon.<br><br><strong>NOTE:</strong> This type of button <strong>must</strong>
     *     always be the first button in the first row and can only be used in invoice messages.
     * @param CopyTextButton|null $copy_text Description of the button that copies the specified text to the clipboard.
     * @param string|null $icon_custom_emoji_id Unique identifier of the custom emoji shown before the text of the
     *     button. Can only be used by bots that purchased additional usernames on Fragment or in the messages directly
     *     sent by the bot to private, group and supergroup chats if the owner of the bot has a Telegram Premium
     *     subscription.
     * @param KeyboardButtonStyle|string|null $style Style of the button. If omitted, then an app-specific style is
     *     used.
     */
    public function __construct(
        public string $text,
        public ?string $url = null,
        public ?string $callback_data = null,
        public ?WebAppInfo $web_app = null,
        public ?LoginUrl $login_url = null,
        public ?string $switch_inline_query = null,
        public ?string $switch_inline_query_current_chat = null,
        public ?SwitchInlineQueryChosenChat $switch_inline_query_chosen_chat = null,
        public ?CallbackGame $callback_game = null,
        public ?bool $pay = null,
        public ?CopyTextButton $copy_text = null,
        public ?string $icon_custom_emoji_id = null,
        public KeyboardButtonStyle|string|null $style = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            text: $data['text'],
            url: $data['url'] ?? null,
            callback_data: $data['callback_data'] ?? null,
            web_app: isset($data['web_app'])
                ? WebAppInfo::makeByArray($data['web_app'])
                : null,
            login_url: isset($data['login_url'])
                ? LoginUrl::makeByArray($data['login_url'])
                : null,
            switch_inline_query: $data['switch_inline_query'] ?? null,
            switch_inline_query_current_chat: $data['switch_inline_query_current_chat'] ?? null,
            switch_inline_query_chosen_chat: isset($data['switch_inline_query_chosen_chat'])
                ? SwitchInlineQueryChosenChat::makeByArray($data['switch_inline_query_chosen_chat'])
                : null,
            callback_game: isset($data['callback_game'])
                ? CallbackGame::makeByArray($data['callback_game'])
                : null,
            pay: $data['pay'] ?? null,
            copy_text: isset($data['copy_text'])
                ? CopyTextButton::makeByArray($data['copy_text'])
                : null,
            icon_custom_emoji_id: $data['icon_custom_emoji_id'] ?? null,
            style: $data['style'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'text' => $this->text,
            'url' => $this->url,
            'callback_data' => $this->callback_data,
            'web_app' => $this->web_app,
            'login_url' => $this->login_url,
            'switch_inline_query' => $this->switch_inline_query,
            'switch_inline_query_current_chat' => $this->switch_inline_query_current_chat,
            'switch_inline_query_chosen_chat' => $this->switch_inline_query_chosen_chat,
            'callback_game' => $this->callback_game,
            'pay' => $this->pay,
            'copy_text' => $this->copy_text,
            'icon_custom_emoji_id' => $this->icon_custom_emoji_id,
            'style' => $this->style,
        ];
    }
}
