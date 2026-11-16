<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object describes an HTML widget.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Widget extends Type
{
    /**
     * @param string $html HTML code of the widget
     * @param string|null $id Unique identifier of the shared widget, which can be used to send the widget again using
     *     the method sendSharedWidget(); omitted if the widget isn't shared
     * @param int|null $width Width of the widget in logical pixels; omitted if the widget must occupy the whole width
     *     of the message bubble
     * @param int|null $height Height of the widget in logical pixels; omitted if the height of the widget isn't fixed
     * @param string|null $public_data Public data of the widget, which is available wherever the widget is shown. All
     *     messages with a shared widget have the same public data.
     * @param string|null $chat_data Data of the widget, which is specific to the message
     */
    public function __construct(
        public string $html,
        public string|null $id = null,
        public int|null $width = null,
        public int|null $height = null,
        public string|null $public_data = null,
        public string|null $chat_data = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            html: $data['html'],
            id: $data['id'] ?? null,
            width: $data['width'] ?? null,
            height: $data['height'] ?? null,
            public_data: $data['public_data'] ?? null,
            chat_data: $data['chat_data'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'html' => $this->html,
            'id' => $this->id,
            'width' => $this->width,
            'height' => $this->height,
            'public_data' => $this->public_data,
            'chat_data' => $this->chat_data,
        ];
    }
}





