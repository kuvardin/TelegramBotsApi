<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents one button of the reply keyboard. For simple text buttons, <em>String</em> can be used instead
 * of this object to specify the button text. The optional fields <em>web_app</em>, <em>request_user</em>,
 * <em>request_chat</em>, <em>request_contact</em>, <em>request_location</em>, and <em>request_poll</em> are mutually
 * exclusive.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class KeyboardButton extends Type
{
    /**
     * @param string $text Text of the button. If none of the optional fields are used, it will be sent as a message
     *     when the button is pressed
     * @param bool|null $request_contact If <em>True</em>, the user's phone number will be sent as a contact when the
     *     button is pressed. Available in private chats only.
     * @param bool|null $request_location If <em>True</em>, the user's current location will be sent when the button is
     *     pressed. Available in private chats only.
     * @param KeyboardButtonPollType|null $request_poll If specified, the user will be asked to create a poll and send
     *     it to the bot when the button is pressed. Available in private chats only.
     * @param WebAppInfo|null $web_app If specified, the described
     *     <a href="https://core.telegram.org/bots/webapps">Web App</a> will be launched when the button is pressed.
     *     The Web App will be able to send a “web_app_data” service message. Available in private chats only.
     * @param KeyboardButtonRequestUsers|null $request_users If specified, pressing the button will open a list of
     *     suitable users. Identifiers of selected users will be sent to the bot in a “users_shared” service message.
     *     Available in private chats only.
     * @param KeyboardButtonRequestChat|null $request_chat If specified, pressing the button will open a list of
     *     suitable chats. Tapping on a chat will send its identifier to the bot in a “chat_shared” service message.
     *     Available in private chats only.
     */
    public function __construct(
        public string $text,
        public ?bool $request_contact = null,
        public ?bool $request_location = null,
        public ?KeyboardButtonPollType $request_poll = null,
        public ?WebAppInfo $web_app = null,
        public ?KeyboardButtonRequestUsers $request_users = null,
        public ?KeyboardButtonRequestChat $request_chat = null,
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
        ];
    }
}
