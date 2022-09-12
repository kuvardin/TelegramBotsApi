<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents one button of an inline keyboard. You <strong>must</strong> use exactly one of the optional
 * fields.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InlineKeyboardButton extends Type
{
    /**
     * @param string $text Label text on the button
     * @param string|null $url HTTP or tg:// url to be opened when the button is pressed. Links
     *     <code>tg://user?id=<user_id></code> can be used to mention a user by their ID without using a username, if
     *     this is allowed by their privacy settings.
     * @param string|null $callback_data Data to be sent in a <a
     *     href="https://core.telegram.org/bots/api#callbackquery">callback query</a> to the bot when button is
     *     pressed, 1-64 bytes
     * @param WebAppInfo|null $web_app Description of the <a href="https://core.telegram.org/bots/webapps">Web App</a>
     *     that will be launched when the user presses the button. The Web App will be able to send an arbitrary
     *     message on behalf of the user using the method answerWebAppQuery(). Available only in private chats between
     *     a user and the bot.
     * @param LoginUrl|null $login_url An HTTPS URL used to automatically authorize the user. Can be used as a
     *     replacement for the <a href="https://core.telegram.org/widgets/login">Telegram Login Widget</a>.
     * @param string|null $switch_inline_query If set, pressing the button will prompt the user to select one of their
     *     chats, open that chat and insert the bot's username and the specified inline query in the input field. Can
     *     be empty, in which case just the bot's username will be inserted.<br><br><strong>Note:</strong> This offers
     *     an easy way for users to start using your bot in <a href="https://core.telegram.org/bots/inline">inline
     *     mode</a> when they are currently in a private chat with it. Especially useful when combined with <a
     *     href="https://core.telegram.org/bots/api#answerinlinequery">switch_pm…</a> actions – in this case the user
     *     will be automatically returned to the chat they switched from, skipping the chat selection screen.
     * @param string|null $switch_inline_query_current_chat If set, pressing the button will insert the bot's username
     *     and the specified inline query in the current chat's input field. Can be empty, in which case only the bot's
     *     username will be inserted.<br><br>This offers a quick way for the user to open your bot in inline mode in
     *     the same chat – good for selecting something from multiple options.
     * @param CallbackGame|null $callback_game Description of the game that will be launched when the user presses the
     *     button.<br><br><strong>NOTE:</strong> This type of button <strong>must</strong> always be the first button
     *     in the first row.
     * @param bool|null $pay Specify <em>True</em>, to send a <a href="https://core.telegram.org/bots/api#payments">Pay
     *     button</a>.<br><br><strong>NOTE:</strong> This type of button <strong>must</strong> always be the first
     *     button in the first row and can only be used in invoice messages.
     */
    public function __construct(
        public string $text,
        public ?string $url = null,
        public ?string $callback_data = null,
        public ?WebAppInfo $web_app = null,
        public ?LoginUrl $login_url = null,
        public ?string $switch_inline_query = null,
        public ?string $switch_inline_query_current_chat = null,
        public ?CallbackGame $callback_game = null,
        public ?bool $pay = null,
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
            callback_game: isset($data['callback_game'])
                ? CallbackGame::makeByArray($data['callback_game'])
                : null,
            pay: $data['pay'] ?? null,
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
            'callback_game' => $this->callback_game,
            'pay' => $this->pay,
        ];
    }
}
