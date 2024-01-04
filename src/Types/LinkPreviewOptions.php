<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Describes the options used for link preview generation.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class LinkPreviewOptions extends Type
{
    /**
     * @param bool|null $is_disabled True, if the link preview is disabled
     * @param string|null $url URL to use for the link preview. If empty, then the first URL found in the message text
     *     will be used
     * @param bool|null $prefer_small_media True, if the media in the link preview is suppposed to be shrunk; ignored
     *     if the URL isn't explicitly specified or media size change isn't supported for the preview
     * @param bool|null $prefer_large_media True, if the media in the link preview is suppposed to be enlarged; ignored
     *     if the URL isn't explicitly specified or media size change isn't supported for the preview
     * @param bool|null $show_above_text True, if the link preview must be shown above the message text; otherwise,
     *     the link preview will be shown below the message text
     */
    public function __construct(
        public ?bool $is_disabled = null,
        public ?string $url = null,
        public ?bool $prefer_small_media = null,
        public ?bool $prefer_large_media = null,
        public ?bool $show_above_text = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            is_disabled: $data['is_disabled'] ?? null,
            url: $data['url'] ?? null,
            prefer_small_media: $data['prefer_small_media'] ?? null,
            prefer_large_media: $data['prefer_large_media'] ?? null,
            show_above_text: $data['show_above_text'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'is_disabled' => $this->is_disabled,
            'url' => $this->url,
            'prefer_small_media' => $this->prefer_small_media,
            'prefer_large_media' => $this->prefer_large_media,
            'show_above_text' => $this->show_above_text,
        ];
    }
}
