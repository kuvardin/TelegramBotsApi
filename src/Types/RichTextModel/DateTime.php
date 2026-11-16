<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichTextModel;

use Kuvardin\TelegramBotsApi\Types\RichTextModel;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\RichText;

/**
 * Formatted date and time.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class DateTime extends RichTextModel
{
    /**
     * @param RichText $text The text
     * @param int $unix_time The Unix time associated with the entity
     * @param string $date_time_format The string that defines the formatting of the date and time. See date-time
     *     entity formatting for more details.
     */
    public function __construct(
        public RichText $text,
        public int $unix_time,
        public string $date_time_format,
    )
    {

    }

    public static function getType(): string
    {
        return 'date_time';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong rich text type: {$data['type']}");
        }

        return new self(
            text: RichText::makeByInput($data['text']),
            unix_time: $data['unix_time'],
            date_time_format: $data['date_time_format'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'text' => $this->text,
            'unix_time' => $this->unix_time,
            'date_time_format' => $this->date_time_format,
        ];
    }
}

