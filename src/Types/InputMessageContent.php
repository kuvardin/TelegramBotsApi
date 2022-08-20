<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object represents the content of a message to be sent as a result of an inline query. Telegram clients
 * currently support the following 5 types:
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class InputMessageContent extends Type
{
    public static function makeByArray(array $data): static
    {
        if (isset($data['message_text'])) {
            return InputMessageContent\Text::makeByArray($data);
        }

        if (isset($data['address'])) {
            return InputMessageContent\Venue::makeByArray($data);
        }

        if (isset($data['latitude'])) {
            return InputMessageContent\Location::makeByArray($data);
        }

        if (isset($data['phone_number'])) {
            return InputMessageContent\Contact::makeByArray($data);
        }

        if (isset($data['payload'])) {
            return InputMessageContent\Invoice::makeByArray($data);
        }

        throw new RuntimeException('Unknown input message content data: ' . print_r($data, true));
    }

    abstract public function getRequestData(): array;
}
