<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents type of a poll, which is allowed to be created and sent when the corresponding button is
 * pressed.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class KeyboardButtonPollType extends Type
{
    /**
     * @var string|null $type If <em>quiz</em> is passed, the user will be allowed to create only polls in the quiz
     *     mode. If <em>regular</em> is passed, only regular polls will be allowed. Otherwise, the user will be allowed
     *     to create a poll of any type.
     */
    public ?string $type = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->type = $data['type'] ?? null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
