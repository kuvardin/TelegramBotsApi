<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this class contains basic information about an invoice.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Invoice implements TypeInterface
{
    /**
     * @var string Product name
     */
    public $title;

    /**
     * @var string Product description
     */
    public $description;

    /**
     * @var string Unique bot deep-linking parameter that can be used to generate this invoice
     */
    public $start_parameter;

    /**
     * @var string Three-letter ISO 4217 currency code
     */
    public $currency;

    /**
     * @var int Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     */
    public $total_amount;

    /**
     * Invoice constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->start_parameter = $data['start_parameter'];
        $this->currency = $data['currency'];
        $this->total_amount = $data['total_amount'];
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'start_parameter' => $this->start_parameter,
            'currency' => $this->currency,
            'total_amount' => $this->total_amount,
        ];
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $start_parameter
     * @param string $currency
     * @param int $total_amount
     * @return Invoice
     */
    public static function make(string $title, string $description, string $start_parameter, string $currency, int $total_amount): self
    {
        return new self([
            'title' => $title,
            'description' => $description,
            'start_parameter' => $start_parameter,
            'currency' => $currency,
            'total_amount' => $total_amount,
        ]);
    }
}