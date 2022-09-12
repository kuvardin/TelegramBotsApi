<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use JsonException;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;

/**
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class Request
{
    public ?int $connect_timeout = null;
    public ?int $read_timeout = null;
    public ?int $request_timeout = null;

    /**
     * @var Bot Telegram bot
     */
    protected Bot $bot;

    /**
     * @var string API method
     */
    protected string $method;

    /**
     * @var array Request parameters
     */
    protected array $parameters;

    public function __construct(Bot $bot, string $method, array $parameters = [])
    {
        $this->bot = $bot;
        $this->method = $method;
        $this->parameters = $parameters;

        $this->connect_timeout = $bot->connect_timeout_default;
        $this->read_timeout = $bot->read_timeout_default;
        $this->request_timeout = $bot->request_timeout_default;
    }

    public function getBot(): Bot
    {
        return $this->bot;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    abstract public function sendRequest(int $attempts = 1);

    /**
     * @throws TelegramBotsApiException
     */
    public function tryToSend(int $attempts = 1): bool
    {
        try {
            $this->request($attempts);

            return true;
        } catch (GuzzleException) {
            return false;
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)json_encode($this->getRequestData(), JSON_THROW_ON_ERROR);
    }

    public function getRequestData(): array
    {
        $params = self::processingParameters($this->parameters);
        $params['method'] = $this->method;
        return $params;
    }

    private static function processingParameters(array $parameters): array
    {
        $result = [];
        foreach ($parameters as $parameter_key => $parameter_value) {
            if ($parameter_value instanceof Type) {
                $parameter_value = $parameter_value->getRequestData();
            }

            if ($parameter_value === null) {
                continue;
            }

            if (is_array($parameter_value)) {
                $array_data = self::processingParameters($parameter_value);
                if (!empty($array_data)) {
                    $result[$parameter_key] = $array_data;
                }
            } elseif (is_scalar($parameter_value)) {
                $result[$parameter_key] = $parameter_value;
            } else {
                $type = gettype($parameter_value);
                throw new RuntimeException("Parameter $parameter_key has unsupported type $type ($parameter_value)");
            }
        }

        return $result;
    }

    /**
     * @throws GuzzleException
     * @throws TelegramBotsApiException
     */
    final protected function request(int $attempts = 1): mixed
    {
        if ($attempts < 1) {
            throw new RuntimeException("Incorrect request attempts number: $attempts");
        }

        $uri = "https://api.telegram.org/bot{$this->bot->getToken()}/{$this->method}";

        $this->bot->last_request_uri = $uri;
        $this->bot->last_response = null;
        $this->bot->last_response_decoded = null;

        $i = 0;
        do {
            $i++;

            try {
                $response = $this->bot->getClient()->post($uri, [
                    RequestOptions::HTTP_ERRORS => false,
                    RequestOptions::HEADERS => [
                        'Content-Type: application/json',
                    ],
                    RequestOptions::JSON => $this->getRequestData(),
                    RequestOptions::TIMEOUT => $this->request_timeout,
                    RequestOptions::READ_TIMEOUT => $this->read_timeout,
                    RequestOptions::CONNECT_TIMEOUT => $this->connect_timeout,
                ]);

                $this->bot->last_response = $response;
                $contents = $response->getBody()->getContents();

                try {
                    $decoded = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
                } catch (JsonException) {
                    throw new TelegramBotsApiException(0, "Returned string is not JSON: $contents", null);
                }

                $this->bot->last_response_decoded = $decoded;

                if ($decoded['ok'] !== true) {
                    $response_parameters = isset($response_decoded['parameters'])
                        ? Types\ResponseParameters::makeByArray($response_decoded['parameters'])
                        : null;

                    throw new TelegramBotsApiException(
                        $decoded['error_code'],
                        $decoded['description'],
                        $response_parameters,
                    );
                }

                return $decoded['result'];
            } catch (GuzzleException $guzzle_exception) {
                if ($guzzle_exception->getCode() !== 28 || $i === $attempts) {
                    throw $guzzle_exception;
                }

                sleep(2);
            }
        } while ($i < $attempts);
    }
}