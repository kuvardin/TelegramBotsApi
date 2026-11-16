<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a button in a RichMessage. Exactly one of the fields other than "text" and "style" must be
 * used to specify the type of the button.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RichMessageButton extends Type
{
    /**
     * @param RichText $text Text of the button. May contain only plain text, RichTextCustomEmoji and RichTextDateTime
     *     entities.
     * @param string|null $style Style of the button. Must be one of “danger”, “success”, “primary”, or “link” (the
     *     button is shown as a regular link without borders). Apps may use theme-specific colors for the button
     *     background and text based on the style. The style “link” is allowed only for callback buttons.
     * @param string|null $url HTTP or tg:// URL to be opened when the button is pressed. Links
     *     "tg://user?id=<user_id>" can be used to mention a user by their identifier without using a username, if this
     *     is allowed by their privacy settings.
     * @param string|null $callback_data Data to be sent in a callback query to the bot when the button is pressed,
     *     1-64 bytes
     * @param WebAppInfo|null $web_app Description of the Web App that will be launched when the user presses the
     *     button. The Web App will be able to send an arbitrary message on behalf of the user using the method
     *     answerWebAppQuery(). Available only in private chats between a user and the bot. Not supported for messages
     *     sent on behalf of a business account.
     * @param LoginUrl|null $login_url An HTTPS URL used to automatically authorize the user. Can be used as a
     *     replacement for the Telegram Login Widget. Not supported for ephemeral messages.
     * @param string|null $switch_inline_query If set, pressing the button will prompt the user to select one of their
     *     chats, open that chat and insert the bot's username and the specified inline query in the input field. May
     *     be empty, in which case just the bot's username will be inserted. Not supported for messages sent in channel
     *     direct messages chats and on behalf of a business account.
     * @param string|null $switch_inline_query_current_chat If set, pressing the button will insert the bot's username
     *     and the specified inline query in the current chat's input field. May be empty, in which case only the bot's
     *     username will be inserted. Not supported in channels and for messages sent in channel direct messages chats
     *     and on behalf of a business account.
     * @param SwitchInlineQueryChosenChat|null $switch_inline_query_chosen_chat If set, pressing the button will prompt
     *     the user to select one of their chats of the specified type, open that chat and insert the bot's username
     *     and the specified inline query in the input field. Not supported for messages sent in channel direct
     *     messages chats and on behalf of a business account.
     * @param CopyTextButton|null $copy_text A button that copies the specified text to the clipboard
     * @param DisabledButton|null $disabled If set, then the button is disabled and does nothing
     */
    public function __construct(
        public RichText $text,
        public ?string $style = null,
        public ?string $url = null,
        public ?string $callback_data = null,
        public ?WebAppInfo $web_app = null,
        public ?LoginUrl $login_url = null,
        public ?string $switch_inline_query = null,
        public ?string $switch_inline_query_current_chat = null,
        public ?SwitchInlineQueryChosenChat $switch_inline_query_chosen_chat = null,
        public ?CopyTextButton $copy_text = null,
        public ?DisabledButton $disabled = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            text: RichText::makeByInput($data['text']),
            style: $data['style'] ?? null,
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
            copy_text: isset($data['copy_text'])
                ? CopyTextButton::makeByArray($data['copy_text'])
                : null,
            disabled: isset($data['disabled'])
                ? DisabledButton::makeByArray($data['disabled'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'text' => $this->text,
            'style' => $this->style,
            'url' => $this->url,
            'callback_data' => $this->callback_data,
            'web_app' => $this->web_app,
            'login_url' => $this->login_url,
            'switch_inline_query' => $this->switch_inline_query,
            'switch_inline_query_current_chat' => $this->switch_inline_query_current_chat,
            'switch_inline_query_chosen_chat' => $this->switch_inline_query_chosen_chat,
            'copy_text' => $this->copy_text,
            'disabled' => $this->disabled,
        ];
    }
}

