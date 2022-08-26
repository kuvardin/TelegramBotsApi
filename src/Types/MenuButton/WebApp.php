<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\MenuButton;

use Kuvardin\TelegramBotsApi\Types\MenuButton;
use Kuvardin\TelegramBotsApi\Types\WebAppInfo;
use RuntimeException;

/**
 * Represents a menu button, which launches a <a href="https://core.telegram.org/bots/webapps">Web App</a>.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class WebApp extends MenuButton
{
    /**
     * @param string $text Text on the button
     * @param WebAppInfo $web_app Description of the Web App that will be launched when the user presses the button.
     *     The Web App will be able to send an arbitrary message on behalf of the user using the method
     *     answerWebAppQuery.
     */
    public function __construct(
        public string $text,
        public WebAppInfo $web_app,
    )
    {

    }

    public static function getType(): string
    {
        return 'web_app';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong menu button type: {$data['type']}");
        }

        return new self(
            text: $data['text'],
            web_app: WebAppInfo::makeByArray($data['web_app']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'web_app' => $this->web_app,
        ];
    }
}
