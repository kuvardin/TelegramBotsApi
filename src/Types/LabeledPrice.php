<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this class represents a portion of the price for goods or services.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class LabeledPrice implements TypeInterface
{
    /**
     * @var string Portion label
     */
    public $label;

    /**
     * @var int Price of the product in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     */
    public $amount;

    /**
     * LabeledPrice constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->label = $data['label'];
        $this->amount = $data['amount'];
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'label' => $this->label,
            'amount' => $this->amount,
        ];
    }

    /**
     * @param string $label
     * @param int $amount
     * @return LabeledPrice
     */
    public static function make(string $label, int $amount): self
    {
        return new self([
            'label' => $label,
            'amount' => $amount,
        ]);
    }
}