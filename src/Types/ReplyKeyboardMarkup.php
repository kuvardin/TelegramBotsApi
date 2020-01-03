<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;

/**
 * This object represents a custom keyboard with reply options
 * (see Introduction to bots for details and examples).
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ReplyKeyboardMarkup implements TypeInterface
{
    /**
     * @var KeyboardButton[][] Array of button rows, each represented by an Array of KeyboardButton objects
     */
    public array $keyboard = [];

    /**
     * @var bool|null Requests clients to resize the keyboard vertically for optimal fit (e.g., make
     * the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case
     * the custom keyboard is always of the same height as the app's standard keyboard.
     */
    public ?bool $resize_keyboard;

    /**
     * @var bool|null Requests clients to hide the keyboard as soon as it's been used. The keyboard will still
     * be available, but clients will automatically display the usual letter-keyboard in the chat – the user can
     * press a special button in the input field to see the custom keyboard again. Defaults to false.
     */
    public ?bool $one_time_keyboard;

    /**
     * @var bool|null Use this parameter if you want to show the keyboard to specific users only. Targets:
     * 1) users that are @mentioned in the text of the Message object;
     * 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * Example: A user requests to change the bot‘s language, bot replies to the request with a keyboard
     * to select the new language. Other users in the group don’t see the keyboard.
     */
    public ?bool $selective;

    /**
     * ReplyKeyboardMarkup constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data['keyboard'] as $row) {
            $keyboard_row = [];
            foreach ($row as $button) {
                $keyboard_row[] = $button instanceof KeyboardButton ? $button : new KeyboardButton($button);
            }
            $this->keyboard[] = $keyboard_row;
        }

        if (isset($data['resize_keyboard'])) {
            $this->resize_keyboard = $data['resize_keyboard'];
        }

        if (isset($data['one_time_keyboard'])) {
            $this->one_time_keyboard = $data['one_time_keyboard'];
        }

        if (isset($data['selective'])) {
            $this->selective = $data['selective'];
        }
    }

    /**
     * @param KeyboardButton[][] $keyboard Array of button rows, each represented by an Array of KeyboardButton objects
     * @return ReplyKeyboardMarkup
     */
    public static function make(array $keyboard): self
    {
        return new self([
            'keyboard' => $keyboard,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'keyboard' => $this->keyboard,
            'resize_keyboard' => $this->resize_keyboard,
            'one_time_keyboard' => $this->one_time_keyboard,
            'selective' => $this->selective,
        ];
    }
}