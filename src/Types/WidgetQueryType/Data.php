<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\WidgetQueryType;

use Kuvardin\TelegramBotsApi\Types\TonWalletCard;
use Kuvardin\TelegramBotsApi\Types\WidgetQueryType;
use RuntimeException;

/**
 * The query contains data for the bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Data extends WidgetQueryType
{
    /**
     * @param TonWalletCard|null $wallet_card TON wallet card of the user who sent the query, if it was sent to the bot
     *     along with the query
     */
    public function __construct(
        public ?TonWalletCard $wallet_card = null,
    )
    {

    }

    public static function getType(): string
    {
        return 'data';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong widget query type: {$data['type']}");
        }

        return new self(
            wallet_card: isset($data['wallet_card'])
                ? TonWalletCard::makeByArray($data['wallet_card'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'wallet_card' => $this->wallet_card,
        ];
    }
}

