<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a service message about a user allowing a bot to write messages after adding it to the
 * attachment menu, launching a Web App from a link, or accepting an explicit request from a Web App sent by the method
 * requestWriteAccess.
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
     */
    public function __construct(
        public ?string $web_app_name = null,
        public ?bool $from_request = null,
        public ?bool $from_attachment_menu = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            web_app_name: $data['web_app_name'] ?? null,
            from_request: $data['from_request'] ?? null,
            from_attachment_menu: $data['from_attachment_menu'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'web_app_name' => $this->web_app_name,
            'from_request' => $this->from_request,
            'from_attachment_menu' => $this->from_attachment_menu,
        ];
    }
}
