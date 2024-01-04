<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a list of boosts added to a chat by a user.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class UserChatBoosts extends Type
{
    /**
     * @param ChatBoost[] $boosts The list of boosts added to the chat by the user
     */
    public function __construct(
        public array $boosts,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        $result = new self(
            boosts: [],
        );

        foreach ($data['boosts'] as $item_data) {
            $result->boosts[] = ChatBoost::makeByArray($item_data);
        }

        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'boosts' => $this->boosts,
        ];
    }
}
