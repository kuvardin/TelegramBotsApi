<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use JsonException;
use Kuvardin\TelegramBotsApi\Enums\ParseMode;
use RuntimeException;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;
use StringBackedEnum;

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

    /**
     * @var array<string, string> Attached file paths
     */
    protected array $attached_file_paths = [];

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
            } elseif ($parameter_value instanceof StringBackedEnum) {
                $parameter_value = $parameter_value->value;
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

    public function attachFileByPath(string $attach_name, string $file_path): self
    {
        if (!file_exists($file_path)) {
            throw new RuntimeException("File not exists: $file_path");
        }

        if (array_key_exists($attach_name, $this->attached_file_paths)) {
            throw new RuntimeException("File $attach_name already attached");
        }

        $this->attached_file_paths[$attach_name] = $file_path;

        return $this;
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

        $request_options = [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::HEADERS => [
                'Content-Type: application/json',
            ],
            RequestOptions::TIMEOUT => $this->request_timeout,
            RequestOptions::READ_TIMEOUT => $this->read_timeout,
            RequestOptions::CONNECT_TIMEOUT => $this->connect_timeout,
        ];

        if ($this->attached_file_paths !== []) {
            $multipart = [];

            foreach ($this->attached_file_paths as $attach_name => $attached_file_path) {
                $multipart[] = [
                    'name' => $attach_name,
                    'contents' => fopen($attached_file_path, 'r'),
                ];
            }

            foreach ($this->getRequestData() as $data_key => $data_value) {
                $multipart[] = [
                    'name' => $data_key,
                    'contents' => is_array($data_value)
                        ? json_encode($data_value, JSON_THROW_ON_ERROR)
                        : $data_value,
                ];
            }

            $request_options[RequestOptions::MULTIPART] = $multipart;
        } else {
            $request_options[RequestOptions::JSON] = $this->getRequestData();
        }

        $i = 0;

        do {
            $i++;

            try {
                $response = $this->bot->getClient()->post($uri, $request_options);

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