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
     * @var string $text Label text on the button
     */
    public string $text;

    /**
     * @var string|null $url HTTP or tg:// url to be opened when the button is pressed. Links
     *     <code>tg://user?id=<user_id></code> can be used to mention a user by their ID without using a username, if
     *     this is allowed by their privacy settings.
     */
    public ?string $url = null;

    /**
     * @var string|null $callback_data Data to be sent in a <a
     *     href="https://core.telegram.org/bots/api#callbackquery">callback query</a> to the bot when button is
     *     pressed, 1-64 bytes
     */
    public ?string $callback_data = null;

    /**
     * @var WebAppInfo|null $web_app Description of the <a href="https://core.telegram.org/bots/webapps">Web App</a>
     *     that will be launched when the user presses the button. The Web App will be able to send an arbitrary
     *     message on behalf of the user using the method <a
     *     href="https://core.telegram.org/bots/api#answerwebappquery">answerWebAppQuery</a>. Available only in private
     *     chats between a user and the bot.
     */
    public ?WebAppInfo $web_app = null;

    /**
     * @var LoginUrl|null $login_url An HTTP URL used to automatically authorize the user. Can be used as a replacement
     *     for the <a href="https://core.telegram.org/widgets/login">Telegram Login Widget</a>.
     */
    public ?LoginUrl $login_url = null;

    /**
     * @var string|null $switch_inline_query If set, pressing the button will prompt the user to select one of their
     *     chats, open that chat and insert the bot's username and the specified inline query in the input field. Can
     *     be empty, in which case just the bot's username will be inserted.<br><br><strong>Note:</strong> This offers
     *     an easy way for users to start using your bot in <a href="https://core.telegram.org/bots/inline">inline
     *     mode</a> when they are currently in a private chat with it. Especially useful when combined with <a
     *     href="https://core.telegram.org/bots/api#answerinlinequery"><em>switch_pm…</em></a> actions – in this case
     *     the user will be automatically returned to the chat they switched from, skipping the chat selection screen.
     */
    public ?string $switch_inline_query = null;

    /**
     * @var string|null $switch_inline_query_current_chat If set, pressing the button will insert the bot's username
     *     and the specified inline query in the current chat's input field. Can be empty, in which case only the bot's
     *     username will be inserted.<br><br>This offers a quick way for the user to open your bot in inline mode in
     *     the same chat – good for selecting something from multiple options.
     */
    public ?string $switch_inline_query_current_chat = null;

    /**
     * @var CallbackGame|null $callback_game Description of the game that will be launched when the user presses the
     *     button.<br><br><strong>NOTE:</strong> This type of button <strong>must</strong> always be the first button
     *     in the first row.
     */
    public ?CallbackGame $callback_game = null;

    /**
     * @var bool|null $pay Specify <em>True</em>, to send a <a href="https://core.telegram.org/bots/api#payments">Pay
     *     button</a>.<br><br><strong>NOTE:</strong> This type of button <strong>must</strong> always be the first
     *     button in the first row and can only be used in invoice messages.
     */
    public ?bool $pay = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->text = $data['text'];
        $result->url = $data['url'] ?? null;
        $result->callback_data = $data['callback_data'] ?? null;
        $result->web_app = isset($data['web_app'])
            ? WebAppInfo::makeByArray($data['web_app'])
            : null;
        $result->login_url = isset($data['login_url'])
            ? LoginUrl::makeByArray($data['login_url'])
            : null;
        $result->switch_inline_query = $data['switch_inline_query'] ?? null;
        $result->switch_inline_query_current_chat = $data['switch_inline_query_current_chat'] ?? null;
        $result->callback_game = isset($data['callback_game'])
            ? CallbackGame::makeByArray($data['callback_game'])
            : null;
        $result->pay = $data['pay'] ?? null;
        return $result;
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
