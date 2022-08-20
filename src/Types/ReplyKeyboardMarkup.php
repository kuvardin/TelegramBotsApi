<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a <a href="https://core.telegram.org/bots#keyboards">custom keyboard</a> with reply options
 * (see <a href="https://core.telegram.org/bots#keyboards">Introduction to bots</a> for details and examples).
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ReplyKeyboardMarkup extends Type
{
    /**
     * @var KeyboardButton[][] $keyboard Array of button rows, each represented by an Array of <a
     *     href="https://core.telegram.org/bots/api#keyboardbutton">KeyboardButton</a> objects
     */
    public array $keyboard;

    /**
     * @var bool|null $resize_keyboard Requests clients to resize the keyboard vertically for optimal fit (e.g., make
     *     the keyboard smaller if there are just two rows of buttons). Defaults to <em>false</em>, in which case the
     *     custom keyboard is always of the same height as the app's standard keyboard.
     */
    public ?bool $resize_keyboard = null;

    /**
     * @var bool|null $one_time_keyboard Requests clients to hide the keyboard as soon as it's been used. The keyboard
     *     will still be available, but clients will automatically display the usual letter-keyboard in the chat – the
     *     user can press a special button in the input field to see the custom keyboard again. Defaults to
     *     <em>false</em>.
     */
    public ?bool $one_time_keyboard = null;

    /**
     * @var string|null $input_field_placeholder The placeholder to be shown in the input field when the keyboard is
     *     active; 1-64 characters
     */
    public ?string $input_field_placeholder = null;

    /**
     * @var bool|null $selective Use this parameter if you want to show the keyboard to specific users only. Targets:
     *     1) users that are @mentioned in the <em>text</em> of the <a
     *     href="https://core.telegram.org/bots/api#message">Message</a> object; 2) if the bot's message is a reply
     *     (has <em>reply_to_message_id</em>), sender of the original message.<br><br><em>Example:</em> A user requests
     *     to change the bot's language, bot replies to the request with a keyboard to select the new language. Other
     *     users in the group don't see the keyboard.
     */
    public ?bool $selective = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->keyboard = [];
        foreach ($data['keyboard'] as $keyboard_buttons_row_data) {
            $keyboard_buttons_row = [];
            foreach ($keyboard_buttons_row_data as $keyboard_button_data) {
                $keyboard_buttons_row[] = KeyboardButton::makeByArray($keyboard_button_data);
            }
            $result->keyboard[] = $keyboard_buttons_row;
        }
        $result->resize_keyboard = $data['resize_keyboard'] ?? null;
        $result->one_time_keyboard = $data['one_time_keyboard'] ?? null;
        $result->input_field_placeholder = $data['input_field_placeholder'] ?? null;
        $result->selective = $data['selective'] ?? null;
        return $result;

    }

    public function getRequestData(): array
    {
        return [
            'keyboard' => $this->keyboard,
            'resize_keyboard' => $this->resize_keyboard,
            'one_time_keyboard' => $this->one_time_keyboard,
            'input_field_placeholder' => $this->input_field_placeholder,
            'selective' => $this->selective,
        ];
    }
}
