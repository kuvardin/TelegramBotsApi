<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use Kuvardin\TelegramBotsApi\Username;

/**
 * This object represents a parameter of the inline keyboard button used to automatically authorize a user. Serves as a
 * great replacement for the Telegram Login Widget when the user is coming from Telegram. All the user needs to do is
 * tap/click a button and confirm that they want to log in:
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class LoginUrl extends Type
{
    /**
     * @param string $url An HTTPS URL to be opened with user authorization data added to the query string when the
     *     button is pressed. If the user refuses to provide authorization data, the original URL without information
     *     about the user will be opened. The data added is the same as described in Receiving authorization
     *     data.<br><br><strong>NOTE:</strong> You <strong>must</strong> always check the hash of the received data to
     *     verify the authentication and the integrity of the data as described in Checking authorization.
     * @param string|null $forward_text New text of the button in forwarded messages.
     * @param Username|string|null $bot_username Username of a bot, which will be used for user authorization. See
     *     Setting up a bot for more details. If not specified, the current bot's username will be assumed. The "url"'s
     *     domain must be the same as the domain linked with the bot. See Linking your domain to the bot for more
     *     details.
     * @param bool|null $request_write_access Pass True to request the permission for your bot to send messages to the
     *     user.
     */
    public function __construct(
        public string $url,
        public ?string $forward_text = null,
        public Username|string|null $bot_username = null,
        public ?bool $request_write_access = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            url: $data['url'],
            forward_text: $data['forward_text'] ?? null,
            bot_username: $data['bot_username'] ?? null,
            request_write_access: $data['request_write_access'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'url' => $this->url,
            'forward_text' => $this->forward_text,
            'bot_username' => $this->bot_username instanceof Username
                ? $this->bot_username->getShort()
                : $this->bot_username,
            'request_write_access' => $this->request_write_access,
        ];
    }
}
