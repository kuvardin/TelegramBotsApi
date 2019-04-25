<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this class contains information about an incoming shipping query.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class ShippingQuery implements TypeInterface
{

    /**
     * @var string Unique query identifier
     */
    public $id;

    /**
     * @var User User who sent the query
     */
    public $from;

    /**
     * @var string Bot specified invoice payload
     */
    public $invoice_payload;

    /**
     * @var ShippingAddress User specified shipping address
     */
    public $shipping_address;

    /**
     * ShippingQuery constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->from = $data['from'];
        $this->invoice_payload = $data['invoice_payload'];
        $this->shipping_address = $data['shipping_address'];
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'id' => $this->id,
            'from' => $this->from,
            'invoice_payload' => $this->invoice_payload,
            'shipping_address' => $this->shipping_address,
        ];
    }

    /**
     * @param string $id
     * @param User $from
     * @param string $invoice_payload
     * @param ShippingAddress $shipping_address
     * @return ShippingQuery
     */
    public static function make(string $id, User $from, string $invoice_payload, ShippingAddress $shipping_address): self
    {
        return new self([
            'id' => $id,
            'from' => $from,
            'invoice_payload' => $invoice_payload,
            'shipping_address' => $shipping_address,
        ]);
    }
}