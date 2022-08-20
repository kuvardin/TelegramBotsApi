<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MessageEntity extends Type
{
    /**
     * @var string $type Type of the entity. Currently, can be “mention” (<code>@username</code>), “hashtag”
     *     (<code>#hashtag</code>), “cashtag” (<code>$USD</code>), “bot_command” (<code>/start@jobs_bot</code>), “url”
     *     (<code>https://telegram.org</code>), “email” (<code>do-not-reply@telegram.org</code>), “phone_number”
     *     (<code>+1-212-555-0123</code>), “bold” (<strong>bold text</strong>), “italic” (<em>italic text</em>),
     *     “underline” (underlined text), “strikethrough” (strikethrough text), “spoiler” (spoiler message), “code”
     *     (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs), “text_mention” (for
     *     users <a href="https://telegram.org/blog/edit#new-mentions">without usernames</a>)
     */
    public string $type;

    /**
     * @var int $offset Offset in UTF-16 code units to the start of the entity
     */
    public int $offset;

    /**
     * @var int $length Length of the entity in UTF-16 code units
     */
    public int $length;

    /**
     * @var string|null $url For “text_link” only, url that will be opened after user taps on the text
     */
    public ?string $url = null;

    /**
     * @var User|null $user For “text_mention” only, the mentioned user
     */
    public ?User $user = null;

    /**
     * @var string|null $language For “pre” only, the programming language of the entity text
     */
    public ?string $language = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->type = $data['type'];
        $result->offset = $data['offset'];
        $result->length = $data['length'];
        $result->url = $data['url'] ?? null;
        $result->user = isset($data['user'])
            ? User::makeByArray($data['user'])
            : null;
        $result->language = $data['language'] ?? null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'type' => $this->type,
            'offset' => $this->offset,
            'length' => $this->length,
            'url' => $this->url,
            'user' => $this->user,
            'language' => $this->language,
        ];
    }
}
