<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if
 * the user has selected the bot's message and tapped 'Reply'). This can be extremely useful if you want to
 * create user-friendly step-by-step interfaces without having to sacrifice <a
 * href="https://core.telegram.org/bots#privacy-mode">privacy mode</a>.<br><br>
 *
 * Example: A <a href="https://t.me/PollBot">poll bot</a> for groups runs in privacy mode (only
 * receives commands, replies to its messages and mentions). There could be two ways to create a new poll:<br>
 *
 * <ul>
 * <li>Explain the user how to send a command with parameters (e.g. /newpoll question answer1 answer2). May be
 * appealing for hardcore users but lacks modern day polish.</li>
 * <li>Guide the user through a step-by-step process. 'Please send me your question', 'Cool, now let's
 * add the first answer option', 'Great. Keep adding answer options, then send /done when you're
 * ready'.</li>
 * </ul>
 *
 * The last option is definitely more attractive. And if you use <a
 * href="https://core.telegram.org/bots/api#forcereply">ForceReply</a> in your bot's questions, it will receive the
 * user's answers even if it only receives replies, commands and mentions - without any extra work for the user.
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
