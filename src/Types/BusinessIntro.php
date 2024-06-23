<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Contains information about the start page settings of a Telegram Business account.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class BusinessIntro extends Type
{
    /**
     * @param string|null $title Title text of the business intro
     * @param string|null $message Message text of the business intro
     * @param Sticker|null $sticker Sticker of the business intro
     */
    public function __construct(
        public ?string $title = null,
        public ?string $message = null,
        public ?Sticker $sticker = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            title: $data['title'] ?? null,
            message: $data['message'] ?? null,
            sticker: isset($data['sticker'])
                ? Sticker::makeByArray($data['sticker'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'sticker' => $this->sticker,
        ];
    }
}
