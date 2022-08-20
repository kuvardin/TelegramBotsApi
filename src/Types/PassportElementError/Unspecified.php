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
     * @var string $type Type of element of the user's Telegram Passport which has the issue
     */
    public string $type;

    /**
     * @var string $element_hash Base64-encoded element hash
     */
    public string $element_hash;

    /**
     * @var string $message Error message
     */
    public string $message;

    public static function getSource(): string
    {
        return 'unspecified';
    }

    public static function makeByArray(array $data): static
    {
        $result = new self;

        if ($data['source'] !== self::getSource()) {
            throw new RuntimeException("Wrong passport element error source: {$data['source']}");
        }

        $result->type = $data['type'];
        $result->element_hash = $data['element_hash'];
        $result->message = $data['message'];
        return $result;
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
