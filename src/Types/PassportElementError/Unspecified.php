<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PassportElementError;

use Kuvardin\TelegramBotsApi\Types\PassportElementError;
use RuntimeException;

/**
 * Represents an issue in an unspecified place. The error is considered resolved when new data is added.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Unspecified extends PassportElementError
{
    /**
     * @param string $type Type of element of the user's Telegram Passport which has the issue
     * @param string $element_hash Base64-encoded element hash
     * @param string $message Error message
     */
    public function __construct(
        public string $type,
        public string $element_hash,
        public string $message,
    )
    {

    }

    public static function makeByArray(array $data): static
    {
        if ($data['source'] !== self::getSource()) {
            throw new RuntimeException("Wrong passport element error source: {$data['source']}");
        }

        return new self(
            type: $data['type'],
            element_hash: $data['element_hash'],
            message: $data['message'],
        );
    }

    public static function getSource(): string
    {
        return 'unspecified';
    }

    public function getRequestData(): array
    {
        return [
            'source' => self::getSource(),
            'type' => $this->type,
            'element_hash' => $this->element_hash,
            'message' => $this->message,
        ];
    }
}
