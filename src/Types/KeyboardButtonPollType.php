<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\PollType;
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
     * @param PollType|string|null $type_value If "quiz" is passed, the user will be allowed to create only polls in
     *     the quiz mode. If "regular" is passed, only regular polls will be allowed. Otherwise, the user will be
     *     allowed to create a poll of any type.
     */
    public function __construct(
        public PollType|string|null $type_value = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            type_value: $data['type'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => $this->type_value,
        ];
    }

    /**
     * @return PollType|null Returns Null if the poll type value is null or unknown.
     */
    public function getType(): ?PollType
    {
        return is_string($this->type_value)
            ? PollType::tryFrom($this->type_value)
            : $this->type_value;
    }
}
