<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\InputRichBlock;

use Kuvardin\TelegramBotsApi\Types\InputRichBlock;
use Kuvardin\TelegramBotsApi\Types\Location;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;
use RuntimeException;

/**
 * A block with a map, corresponding to the custom HTML tag "&lt;tg-map&gt;". The map's width and height must not
 * exceed 10000 in total. The width and height ratio must be at most 20.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Map extends InputRichBlock
{
    /**
     * @param Location $location Location of the center of the map
     * @param int|null $zoom Map zoom level; 0-24
     * @param int|null $width Map width; 0-10000
     * @param int|null $height Map height; 0-10000
     * @param RichBlockCaption|null $caption Caption of the block
     */
    public function __construct(
        public Location $location,
        public ?int $zoom = null,
        public ?int $width = null,
        public ?int $height = null,
        public ?RichBlockCaption $caption = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'map';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong input rich block type: {$data['type']}");
        }

        return new self(
            location: Location::makeByArray($data['location']),
            zoom: $data['zoom'] ?? null,
            width: $data['width'] ?? null,
            height: $data['height'] ?? null,
            caption: isset($data['caption'])
                ? RichBlockCaption::makeByArray($data['caption'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'location' => $this->location,
            'zoom' => $this->zoom,
            'width' => $this->width,
            'height' => $this->height,
            'caption' => $this->caption,
        ];
    }
}

