<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object represents a parameter of the inline keyboard button used to automatically authorize a user.
 * Serves as a great replacement for the Telegram Login Widget when the user is coming from Telegram.
 * All the user needs to do is tap/click a button and confirm that they want to log in.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class LoginUrl implements TypeInterface
{
    /**
     * @var string An HTTP URL to be opened with user authorization data added to the query string when the
     * button is pressed. If the user refuses to provide authorization data, the original URL without information
     * about the user will be opened. The data added is the same as described in Receiving authorization data.
     * NOTE: You must always check the hash of the received data to verify the authentication and the integrity
     * of the data as described in Checking authorization.
     */
    public string $url;

    /**
     * @var string|null New text of the button in forwarded messages.
     */
    public ?string $forward_text = null;

    /**
     * @var string|null Username of a bot, which will be used for user authorization. See Setting up a bot for
     * more details. If not specified, the current bot's username will be assumed. The url's domain must be
     * the same as the domain linked with the bot. See Linking your domain to the bot for more details.
     */
    public ?string $bot_username = null;

    /**
     * @var bool|null Pass True to request the permission for your bot to send messages to the user.
     */
    public ?bool $request_write_access = null;

    /**
     * LoginUrl constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->url = $data['url'];

        if (isset($data['forward_text'])) {
            $this->forward_text = $data['forward_text'];
        }

        if (isset($data['bot_username'])) {
            $this->bot_username = $data['bot_username'];
        }

        if (isset($data['request_write_access'])) {
            $this->request_write_access = $data['request_write_access'];
        }
    }

    /**
     * @param string $url An HTTP URL to be opened with user authorization data added to the query string
     * when the button is pressed. If the user refuses to provide authorization data, the original URL
     * without information about the user will be opened. The data added is the same as described in
     * Receiving authorization data.
     * NOTE: You must always check the hash of the received data to verify the authentication and the integrity
     * of the data as described in Checking authorization.
     * @return LoginUrl
     */
    public static function make(string $url): self
    {
        return new self([
            'url' => $url,
        ]);
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
}