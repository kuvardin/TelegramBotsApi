<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\WidgetQueryType;

use Kuvardin\TelegramBotsApi\Types\WidgetQueryType;
use Kuvardin\TelegramBotsApi\Types\WidgetQueryWallet;
use RuntimeException;

/**
 * The query notifies the bot about a transaction sent from a TON wallet of the user who sent the query.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class SentTransaction extends WidgetQueryType
{
    /**
     * @param WidgetQueryWallet $wallet The wallet from which the transaction was sent
     * @param string $msg_hash Value of "msg_hash" of the transaction
     */
    public function __construct(
        public WidgetQueryWallet $wallet,
        public string $msg_hash,
    )
    {

    }

    public static function getType(): string
    {
        return 'sent_transaction';
    }

    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong widget query type: {$data['type']}");
        }

        return new self(
            wallet: WidgetQueryWallet::makeByArray($data['wallet']),
            msg_hash: $data['msg_hash'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'wallet' => $this->wallet,
            'msg_hash' => $this->msg_hash,
        ];
    }
}





