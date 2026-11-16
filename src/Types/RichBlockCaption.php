<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * Caption of a rich formatted block.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RichBlockCaption extends Type
{
    /**
     * @param RichText $text Block caption
     * @param RichText|null $credit Block credit which corresponds to the HTML tag <cite>
     */
    public function __construct(
        public RichText $text,
        public ?RichText $credit = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            text: RichText::makeByInput($data['text']),
            credit: isset($data['credit'])
                ? RichText::makeByInput($data['credit'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'text' => $this->text,
            'credit' => $this->credit,
        ];
    }
}

