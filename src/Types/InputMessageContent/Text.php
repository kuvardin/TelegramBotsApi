<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMessageContent;

use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use Kuvardin\TelegramBotsApi\Types\MessageEntity;

/**
 * Represents the <a href="https://core.telegram.org/bots/api#inputmessagecontent">content</a> of a text message to be
 * sent as the result of an inline query.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Text extends InputMessageContent
{
    /**
     * @param string $message_text Text of the message to be sent, 1-4096 characters
     * @param string|null $parse_mode Mode for parsing entities in the message text. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param MessageEntity[]|null $entities List of special entities that appear in message text, which can be
     *     specified instead of <em>parse_mode</em>
     * @param bool|null $disable_web_page_preview Disables link previews for links in the sent message
     */
    public function __construct(
        public string $message_text,
        public ?string $parse_mode = null,
        public ?array $entities = null,
        public ?bool $disable_web_page_preview = null,
    )
    {

    }

    public static function makeByArray(array $data): static
    {
        $result = new self(
            message_text: $data['message_text'],
            parse_mode: $data['parse_mode'] ?? null,
            entities: null,
            disable_web_page_preview: $data['disable_web_page_preview'] ?? null,
        );

        if (isset($data['entities'])) {
            $result->entities = [];
            foreach ($data['entities'] as $item_data) {
                $result->entities[] = MessageEntity::makeByArray($item_data);
            }
        }
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'message_text' => $this->message_text,
            'parse_mode' => $this->parse_mode,
            'entities' => $this->entities,
            'disable_web_page_preview' => $this->disable_web_page_preview,
        ];
    }
}
