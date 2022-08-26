<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains information about a <a href="https://core.telegram.org/bots/webapps">Web App</a>.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class WebAppInfo extends Type
{
    /**
     * @param string $url An HTTPS URL of a Web App to be opened with additional data as specified in <a
     *     href="https://core.telegram.org/bots/webapps#initializing-web-apps">Initializing Web Apps</a>
     */
    public function __construct(
        public string $url,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            url: $data['url'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'url' => $this->url,
        ];
    }
}
