<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * This object represents the content of a message to be sent as a result of an inline query.
 * Telegram clients currently support the following 4 types
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InputMessageContent
{
    public const TYPE_TEXT = 'text';
    public const TYPE_LOCATION = 'location';
    public const TYPE_VENUE = 'venue';
    public const TYPE_CONTACT = 'contact';

    /**
     * InputMessageContent constructor.
     *
     * @param array $data
     */
    protected function __construct(array $data)
    {
    }

    /**
     * @param array $data
     * @return InputMessageContent
     * @throws TelegramBotsApi\Exceptions\Error
     */
    public static function constructChild(array $data): InputMessageContent
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