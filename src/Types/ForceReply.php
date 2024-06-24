<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if
 * the user has selected the bot&#39;s message and tapped &#39;Reply&#39;). This can be extremely useful if you want to
 * create user-friendly step-by-step interfaces without having to sacrifice privacy mode. Not supported in channels and
 * for messages sent on behalf of a Telegram Business account.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ForceReply extends Type
{
    /**
     * @param bool $force_reply Shows reply interface to the user, as if they manually selected the bot's message and
     *     tapped 'Reply'
     * @param string|null $input_field_placeholder The placeholder to be shown in the input field when the reply is
     *     active; 1-64 characters
     * @param bool|null $selective Use this parameter if you want to force reply from specific users only. Targets: 1)
     *     users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply
     *     (has reply_to_message_id), sender of the original message.
     */
    public function __construct(
        public bool $force_reply,
        public ?string $input_field_placeholder = null,
        public ?bool $selective = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            force_reply: $data['force_reply'],
            input_field_placeholder: $data['input_field_placeholder'] ?? null,
            selective: $data['selective'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'force_reply' => $this->force_reply,
            'input_field_placeholder' => $this->input_field_placeholder,
            'selective' => $this->selective,
        ];
    }
}
