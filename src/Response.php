<?php

namespace TelegramBotsApi;

/**
 * Class Response
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Response
{
    /**
     * @var string
     */
    public $method;

    /**
     * @var array|null
     */
    public $info;

    /**
     * @var mixed
     */
    public $data;

    /**
     * Response constructor.
     * @param string $method
     * @param array $result
     * @param array|null $info
     */
    public function __construct(string $method, array $result, array $info = null)
    {
        $this->method = $method;
        $this->info = $info;
        $this->data = $result['result'];
    }
}