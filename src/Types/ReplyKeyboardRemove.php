<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Upon receiving a message with this object, Telegram clients will remove the current custom keyboard and display the
 * default letter-keyboard. By default, custom keyboards are displayed until a new keyboard is sent by a bot. An
 * exception is made for one-time keyboards that are hidden immediately after the user presses a button (see <a
 * href="https://core.telegram.org/bots/api#replykeyboardmarkup">ReplyKeyboardMarkup</a>).
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ReplyKeyboardRemove extends Type
{
    /**
     * @param bool $remove_keyboard Requests clients to remove the custom keyboard (user will not be able to summon
     *     this keyboard; if you want to hide the keyboard from sight but keep it accessible, use
     *     <em>one_time_keyboard</em> in ReplyKeyboardMarkup)
     * @param bool|null $selective Use this parameter if you want to remove the keyboard for specific users only.
     *     Targets: 1) users that are @mentioned in the <em>text</em> of the Message object; 2) if the bot's message is
     *     a reply (has <em>reply_to_message_id</em>), sender of the original message.<br><br><em>Example:</em> A user
     *     votes in a poll, bot returns confirmation message in reply to the vote and removes the keyboard for that
     *     user, while still showing the keyboard with poll options to users who haven't voted yet.
     */
    public function __construct(
        public bool $remove_keyboard,
        public ?bool $selective = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            remove_keyboard: $data['remove_keyboard'],
            selective: $data['selective'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'remove_keyboard' => $this->remove_keyboard,
            'selective' => $this->selective,
        ];
    }
}
