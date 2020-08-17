<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PassportElementError;

use Kuvardin\TelegramBotsApi\Exceptions\Error;
use Kuvardin\TelegramBotsApi\Types;

/**
 * Represents an issue in an unspecified place. The error is considered resolved when new data is added.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Unspecified extends Types\PassportElementError implements Types\TypeInterface
{
    public const SOURCE = Types\PassportElementError::SOURCE_UNSPECIFIED;

    /**
     * @var string Error source, must be unspecified
     */
    public string $source;

    /**
     * @var string Type of element of the user's Telegram Passport which has the issue
     */
    public string $type;

    /**
     * @var string Base64-encoded element hash
     */
    public string $element_hash;

    /**
     * @var string Error message
     */
    public string $message;

    /**
     * Unspecified constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($data['source'] !== self::SOURCE) {
            throw new Error("Unknown source: {$data['sourse']} (must be self::SOURCE)");
        }

        $this->type = $data['type'];
        $this->element_hash = $data['element_hash'];
        $this->message = $data['message'];
    }

    /**
     * @param string $type Type of element of the user's Telegram Passport which has the issue
     * @param string $element_hash Base64-encoded element hash
     * @param string $message Error message
     * @return Unspecified
     */
    public static function make(string $type, string $element_hash, string $message): self
    {
        return new self([
            'type' => $type,
            'element_hash' => $element_hash,
            'message' => $message,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'source' => self::SOURCE,
            'type' => $this->type,
            'element_hash' => $this->element_hash,
            'message' => $this->message,
        ];
    }
}
