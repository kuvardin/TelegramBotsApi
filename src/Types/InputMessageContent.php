<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * This object represents the content of a message to be sent as a result of an inline query. Telegram clients currently support the following 4 types:
 *    InputTextMessageContent
 *    InputLocationMessageContent
 *    InputVenueMessageContent
 *    InputContactMessageContent
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class InputMessageContent
{
    public const TYPE_TEXT = 'text';
    public const TYPE_LOCATION = 'location';
    public const TYPE_VENUE = 'venue';
    public const TYPE_CONTACT = 'contact';

    /**
     * @param array $data
     * @return Object
     * @throws Error
     */
    public static function new(array $data): Object
    {
        switch (true) {
            case isset($data['phone_number'], $data['first_name']):
                return new InputMessageContent\Contact($data);
            case isset($data['latitude'], $data['longitude'], $data['title'], $data['address']):
                return new InputMessageContent\Venue($data);
            case isset($data['latitude'], $data['longitude']):
                return new InputMessageContent\Location($data);
            case isset($data['message_text']):
                return new InputMessageContent\Text($data);
        }

        $data_keys = array_keys($data);
        throw new Error("Unknown data keys: {$data_keys}");
    }
}