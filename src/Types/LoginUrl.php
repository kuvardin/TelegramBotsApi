<?php

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * Instance of this object represents a parameter of the inline keyboard button used to automatically authorize a user. Serves as a great replacement for the Telegram Login Widget when the user is coming from Telegram.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class LoginUrl implements TypeInterface
{
    /**
     * @var string n HTTP URL to be opened with user authorization data added to the query string when the button is pressed. If the user refuses to provide authorization data, the original URL without information about the user will be opened. The data added is the same as described in Receiving authorization data.
     */
    public $url;

    /**
     * @var string|null New text of the button in forwarded messages
     */
    public $forward_text;

    /**
     * @var string|null Username of a bot, which will be used for user authorization. See Setting up a bot for more details. If not specified, the current bot's username will be assumed. The url's domain must be the same as the domain linked with the bot. See Linking your domain to the bot for more details.
     */
    public $bot_username;

    /**
     * @var bool|null Pass True to request the permission for your bot to send messages to the user
     */
    public $request_write_access;

    /**
     * Location constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->url = $data['url'];
        $this->forward_text = $data['forward_text'] ?? null;
        $this->bot_username = $data['bot_username'] ?? null;
        $this->request_write_access = $data['request_write_access'] ?? null;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'url' => $this->url,
            'forward_text' => $this->forward_text,
            'bot_username' => $this->bot_username,
            'request_write_access' => $this->request_write_access,
        ];
    }

    /**
     * @param string $url
     * @return LoginUrl
     */
    public static function make(string $url): self
    {
        return new self([
            'url' => $url,
        ]);
    }
}