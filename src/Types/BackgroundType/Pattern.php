<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\BackgroundType;

use Kuvardin\TelegramBotsApi\Types\BackgroundFill;
use Kuvardin\TelegramBotsApi\Types\BackgroundType;
use Kuvardin\TelegramBotsApi\Types\Document;
use RuntimeException;

/**
 * The background is a PNG or TGV (gzipped subset of SVG with MIME type “application/x-tgwallpattern”) pattern to be
 * combined with the background fill chosen by the user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Pattern extends BackgroundType
{
    /**
     * @param Document $document Document with the pattern
     * @param BackgroundFill $fill The background fill that is combined with the pattern
     * @param int $intensity Intensity of the pattern when it is shown above the filled background; 0-100
     * @param bool|null $is_inverted True, if the background fill must be applied only to the pattern itself.
     *     All other pixels are black in this case. For dark themes only
     * @param bool|null $is_moving True, if the background moves slightly when the device is tilted
     */
    public function __construct(
        public Document $document,
        public BackgroundFill $fill,
        public int $intensity,
        public ?bool $is_inverted = null,
        public ?bool $is_moving = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'pattern';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong chat theme type: {$data['type']}");
        }

        return new self(
            document: Document::makeByArray($data['document']),
            fill: BackgroundFill::makeByArray($data['fill']),
            intensity: $data['intensity'],
            is_inverted: $data['is_inverted'] ?? null,
            is_moving: $data['is_moving'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'document' => $this->document,
            'fill' => $this->fill,
            'intensity' => $this->intensity,
            'is_inverted' => $this->is_inverted,
            'is_moving' => $this->is_moving,
        ];
    }
}
