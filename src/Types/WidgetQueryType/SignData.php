<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\WidgetQueryType;

use Kuvardin\TelegramBotsApi\Types\WidgetQueryType;
use Kuvardin\TelegramBotsApi\Types\WidgetQueryWallet;
use RuntimeException;

/**
 * The query contains data signed by a TON wallet of the user who sent the query. The data is signed for the domain
 * "bot&lt;bot_id&gt;", where "&lt;bot_id&gt;" is the identifier of the bot.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SignData extends WidgetQueryType
{
    /**
     * @param WidgetQueryWallet $wallet The wallet that signed the data
     * @param string $sign_data JSON-serialized signed data
     */
    public function __construct(
        public WidgetQueryWallet $wallet,
        public string $sign_data,
    )
    {

    }

    public static function getType(): string
    {
        return 'sign_data';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong widget query type: {$data['type']}");
        }

        return new self(
            wallet: WidgetQueryWallet::makeByArray($data['wallet']),
            sign_data: $data['sign_data'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'wallet' => $this->wallet,
            'sign_data' => $this->sign_data,
        ];
    }
}

