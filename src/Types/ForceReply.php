<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if
 * the user has selected the bot&#39;s message and tapped &#39;Reply&#39;). This can be extremely useful if you want to
 * create user-friendly step-by-step interfaces without having to sacrifice <a
 * href="https://core.telegram.org/bots#privacy-mode">privacy mode</a>.<br><br>
 *
 * <strong>Example:</strong> A <a href="https://t.me/PollBot">poll bot</a> for groups runs in privacy mode (only
 * receives commands, replies to its messages and mentions). There could be two ways to create a new poll:<br>
 *
 * <ul>
 * <li>Explain the user how to send a command with parameters (e.g. /newpoll question answer1 answer2). May be
 * appealing for hardcore users but lacks modern day polish.</li>
 * <li>Guide the user through a step-by-step process. &#39;Please send me your question&#39;, &#39;Cool, now let&#39;s
 * add the first answer option&#39;, &#39;Great. Keep adding answer options, then send /done when you&#39;re
 * ready&#39;.</li>
 * </ul>
 *
 * The last option is definitely more attractive. And if you use <a
 * href="https://core.telegram.org/bots/api#forcereply">ForceReply</a> in your bot&#39;s questions, it will receive the
 * user&#39;s answers even if it only receives replies, commands and mentions - without any extra work for the user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ForceReply extends Type
{
    /**
     * @var bool $force_reply Shows reply interface to the user, as if they manually selected the bot's message and
     *     tapped 'Reply'
     */
    public bool $force_reply;

    /**
     * @var string|null $input_field_placeholder The placeholder to be shown in the input field when the reply is
     *     active; 1-64 characters
     */
    public ?string $input_field_placeholder = null;

    /**
     * @var bool|null $selective Use this parameter if you want to force reply from specific users only. Targets: 1)
     *     users that are @mentioned in the <em>text</em> of the <a
     *     href="https://core.telegram.org/bots/api#message">Message</a> object; 2) if the bot's message is a reply
     *     (has <em>reply_to_message_id</em>), sender of the original message.
     */
    public ?bool $selective = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->force_reply = $data['force_reply'];
        $result->input_field_placeholder = $data['input_field_placeholder'] ?? null;
        $result->selective = $data['selective'] ?? null;
        return $result;
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
