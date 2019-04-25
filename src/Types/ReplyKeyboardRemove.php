<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Upon receiving a message with onstance of this object, Telegram clients will remove the current custom keyboard and display the default letter-keyboard. By default, custom keyboards are displayed until a new keyboard is sent by a bot. An exception is made for one-time keyboards that are hidden immediately after the user presses a button (see ReplyKeyboardMarkup).
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class ReplyKeyboardRemove implements TypeInterface
{
    /**
     * @var bool Requests clients to remove the custom keyboard (user will not be able to summon this keyboard; if you want to hide the keyboard from sight but keep it accessible, use one_time_keyboard in ReplyKeyboardMarkup)
     */
    public $remove_keyboard;

    /**
     * @var bool|null Use this parameter if you want to remove the keyboard for specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     */
    public $selective;

    /**
     * ReplyKeyboardRemove constructor.
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        if (isset($data['remove_keyboard']) && $data['remove_keyboard'] !== true) {
            throw new Error('Parameter "remove_keyboard" must be true');
        }
        $this->remove_keyboard = true;
        $this->selective = $data['selective'] ?? null;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'remove_keyboard' => $this->remove_keyboard,
            'selective' => $this->selective,
        ];
    }

    /**
     * @return ReplyKeyboardRemove
     * @throws Error
     */
    public static function make(): self
    {
        return new self([

        ]);
    }
}