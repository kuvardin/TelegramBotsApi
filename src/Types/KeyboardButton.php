<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use Kuvardin\TelegramBotsApi\Enums\KeyboardButtonStyle;

/**
 * This object represents one button of the reply keyboard. At most one of the fields other than "text",
 * "icon_custom_emoji_id", and "style" must be used to specify the type of the button. For simple text buttons,
 * "String" can be used instead of this object to specify the button text.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class KeyboardButton extends Type
{
    /**
     * @param string $text Text of the button. If none of the fields other than "text", "icon_custom_emoji_id", and
     *     "style" are used, it will be sent as a message when the button is pressed
     * @param bool|null $request_contact If True, the user's phone number will be sent as a contact when the button is
     *     pressed. Available in private chats only.
     * @param bool|null $request_location If True, the user's current location will be sent when the button is pressed.
     *     Available in private chats only.
     * @param KeyboardButtonPollType|null $request_poll If specified, the user will be asked to create a poll and send
     *     it to the bot when the button is pressed. Available in private chats only.
     * @param WebAppInfo|null $web_app If specified, the described Web App will be launched when the button is pressed.
     *     The Web App will be able to send a “web_app_data” service message. Available in private chats only.
     * @param KeyboardButtonRequestUsers|null $request_users If specified, pressing the button will open a list of
     *     suitable users. Identifiers of selected users will be sent to the bot in a “users_shared” service message.
     *     Available in private chats only.
     * @param KeyboardButtonRequestChat|null $request_chat If specified, pressing the button will open a list of
     *     suitable chats. Tapping on a chat will send its identifier to the bot in a “chat_shared” service message.
     *     Available in private chats only.
     * @param string|null $icon_custom_emoji_id Unique identifier of the custom emoji shown before the text of the
     *     button. Can only be used by bots that purchased additional usernames on Fragment or in the messages directly
     *     sent by the bot to private, group and supergroup chats if the owner of the bot has a Telegram Premium
     *     subscription.
     * @param KeyboardButtonStyle|string|null $style Style of the button. Must be one of “danger” (red), “success”
     *     (green) or “primary” (blue). If omitted, then an app-specific style is used.
     * @param KeyboardButtonRequestManagedBot|null $request_managed_bot If specified, pressing the button will ask the
     *     user to create and share a bot that will be managed by the current bot. Available for bots that enabled
     *     management of other bots in the &#64;BotFather Mini App. Available in private chats only.
     */
    public function __construct(
        public string $text,
        public ?bool $request_contact = null,
        public ?bool $request_location = null,
        public ?KeyboardButtonPollType $request_poll = null,
        public ?WebAppInfo $web_app = null,
        public ?KeyboardButtonRequestUsers $request_users = null,
        public ?KeyboardButtonRequestChat $request_chat = null,
        public ?string $icon_custom_emoji_id = null,
        public KeyboardButtonStyle|string|null $style = null,
        public KeyboardButtonRequestManagedBot|null $request_managed_bot = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            text: $data['text'],
            request_contact: $data['request_contact'] ?? null,
            request_location: $data['request_location'] ?? null,
            request_poll: isset($data['request_poll'])
                ? KeyboardButtonPollType::makeByArray($data['request_poll'])
                : null,
            web_app: isset($data['web_app'])
                ? WebAppInfo::makeByArray($data['web_app'])
                : null,
            request_users: isset($data['request_users'])
                ? KeyboardButtonRequestUsers::makeByArray($data['request_users'])
                : null,
            request_chat: isset($data['request_chat'])
                ? KeyboardButtonRequestChat::makeByArray($data['request_chat'])
                : null,
            icon_custom_emoji_id: $data['icon_custom_emoji_id'] ?? null,
            style: $data['style'] ?? null,
            request_managed_bot: isset($data['request_managed_bot'])
                ? KeyboardButtonRequestManagedBot::makeByArray($data['request_managed_bot'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'text' => $this->text,
            'request_contact' => $this->request_contact,
            'request_location' => $this->request_location,
            'request_poll' => $this->request_poll,
            'web_app' => $this->web_app,
            'request_users' => $this->request_users,
            'request_chat' => $this->request_chat,
            'icon_custom_emoji_id' => $this->icon_custom_emoji_id,
            'style' => $this->style,
            'request_managed_bot' => $this->request_managed_bot,
        ];
    }
}
