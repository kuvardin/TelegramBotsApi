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
     * @var string $url An HTTPS URL of a Web App to be opened with additional data as specified in <a
     *     href="https://core.telegram.org/bots/webapps#initializing-web-apps">Initializing Web Apps</a>
     */
    public string $url;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->url = $data['url'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'url' => $this->url,
        ];
    }
}
