<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputMessageContent;

use Kuvardin\TelegramBotsApi\Types\InputMessageContent;
use Kuvardin\TelegramBotsApi\Types\InputRichMessage;

/**
 * Represents the content of a rich message to be sent as the result of an inline query.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Rich extends InputMessageContent
{
    /**
     * @param InputRichMessage $rich_message The message to be sent. Only previously uploaded files may be used in the
     *     message.
     */
    public function __construct(
        public InputRichMessage $rich_message,
    )
    {

    }

    public static function makeByArray(array $data): static
    {
        return new self(
            rich_message: InputRichMessage::makeByArray($data['rich_message']),
        );
    }

    public function getRequestData(): array
    {
        return [
            'rich_message' => $this->rich_message,
        ];
    }
}

