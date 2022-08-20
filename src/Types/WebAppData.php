<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains data sent from a <a href="https://core.telegram.org/bots/webapps">Web App</a> to the bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class WebAppData extends Type
{
    /**
     * @var string $data The data. Be aware that a bad client can send arbitrary data in this field.
     */
    public string $data;

    /**
     * @var string $button_text Text of the <em>web_app</em> keyboard button, from which the Web App was opened. Be
     *     aware that a bad client can send arbitrary data in this field.
     */
    public string $button_text;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->data = $data['data'];
        $result->button_text = $data['button_text'];
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'data' => $this->data,
            'button_text' => $this->button_text,
        ];
    }
}
