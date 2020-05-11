<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMessageContent;

use Kuvardin\TelegramBotsApi\Types;

/**
 * Represents the content of a text message to be sent as the result of an inline query.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Text extends Types\InputMessageContent implements Types\TypeInterface
{
    public const TYPE = Types\InputMessageContent::TYPE_TEXT;

    /**
     * @var string Text of the message to be sent, 1-4096 characters
     */
    public string $message_text;

    /**
     * @var string|null Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width
     * text or inline URLs in your bot's message.
     */
    public ?string $parse_mode = null;

    /**
     * @var bool|null Disables link previews for links in the sent message
     */
    public ?bool $disable_web_page_preview = null;

    /**
     * Text constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->message_text = $data['message_text'];

        if (isset($data['parse_mode'])) {
            $this->parse_mode = $data['parse_mode'];
        }

        if (isset($data['disable_web_page_preview'])) {
            $this->disable_web_page_preview = $data['disable_web_page_preview'];
        }
    }

    /**
     * @param string $message_text Text of the message to be sent, 1-4096 characters
     * @return Text
     */
    public static function make(string $message_text): self
    {
        return new self([
            'message_text' => $message_text,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'message_text' => $this->message_text,
            'parse_mode' => $this->parse_mode,
            'disable_web_page_preview' => $this->disable_web_page_preview,
        ];
    }
}
