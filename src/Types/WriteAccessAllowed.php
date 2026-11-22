<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about a user allowing a bot to write messages after adding it to the
 * attachment menu, launching a Web App from a link, or accepting an explicit request from a Web App sent by the method
 * requestWriteAccess(), or about a user being invited to the private chat with the bot by the owner of the bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class WriteAccessAllowed extends Type
{
    /**
     * @param string|null $web_app_name Name of the Web App, if the access was granted when the Web App was launched
     *     from a link
     * @param bool|null $from_request True, if the access was granted after the user accepted an explicit request from
     *     a Web App sent by the method requestWriteAccess()
     * @param bool|null $from_attachment_menu True, if the access was granted when the bot was added to the attachment
     *     or side menu
     * @param User|null $inviter The owner of the bot, if the access was granted when the owner invited the user to the
     *     private chat with the bot. Bot owners can invite up to 10 users at once by pressing the link
     *     'https://t.me/botinvite/<bot_username>'.
     */
    public function __construct(
        public ?string $web_app_name = null,
        public ?bool $from_request = null,
        public ?bool $from_attachment_menu = null,
        public ?User $inviter = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            web_app_name: $data['web_app_name'] ?? null,
            from_request: $data['from_request'] ?? null,
            from_attachment_menu: $data['from_attachment_menu'] ?? null,
            inviter: isset($data['inviter'])
                ? User::makeByArray($data['inviter'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'web_app_name' => $this->web_app_name,
            'from_request' => $this->from_request,
            'from_attachment_menu' => $this->from_attachment_menu,
            'inviter' => $this->inviter,
        ];
    }
}
