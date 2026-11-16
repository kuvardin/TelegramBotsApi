<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\RichBlock;

use Kuvardin\TelegramBotsApi\Types\RichBlock;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Types\Location;
use Kuvardin\TelegramBotsApi\Types\RichBlockCaption;

/**
 * A block with a map, corresponding to the custom HTML tag "&lt;tg-map&gt;".
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Map extends RichBlock
{
    /**
     * @param Location $location Location of the center of the map
     * @param int $zoom Map zoom level
     * @param int $width Expected width of the map
     * @param int $height Expected height of the map
     * @param RichBlockCaption|null $caption Caption of the block
     */
    public function __construct(
        public Location $location,
        public int $zoom,
        public int $width,
        public int $height,
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
            throw new RuntimeException("Wrong rich block type: {$data['type']}");
        }

        return new self(
            location: Location::makeByArray($data['location']),
            zoom: $data['zoom'],
            width: $data['width'],
            height: $data['height'],
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

