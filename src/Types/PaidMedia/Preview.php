<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\PaidMedia;

use Kuvardin\TelegramBotsApi\Types\PaidMedia;
use RuntimeException;

/**
 * The paid media isn&#39;t available before the payment.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Preview extends PaidMedia
{
    /**
     * @param int|null $width Media width as defined by the sender
     * @param int|null $height Media height as defined by the sender
     * @param int|null $duration Duration of the media in seconds as defined by the sender
     */
    public function __construct(
        public ?int $width = null,
        public ?int $height = null,
        public ?int $duration = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'preview';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong paid media type: {$data['type']}");
        }

        return new self(
            width: $data['width'] ?? null,
            height: $data['height'] ?? null,
            duration: $data['duration'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'width' => $this->width,
            'height' => $this->height,
            'duration' => $this->duration,
        ];
    }
}
