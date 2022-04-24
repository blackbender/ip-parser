<?php

namespace App\Services\IpParser\Adapters;

use Illuminate\Support\Facades\Http;

class IpApiAdapter implements Interfaces\ParserAdapterInterface
{
    /**
     * @var string
     */
    private const URL = 'http://ip-api.com/json/';

    /**
     * @var array
     */
    private array $response;

    /**
     * @param string $ip
     * @return bool
     */
    public function parse(string $ip): bool
    {
        $response = Http::get(self::URL . $ip)->json();
        $this->response = $response;

        $this->ip = $ip;

        return (bool)$response;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return  $this->response['countryCode'] ?? '';
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return  $this->response['country'] ?? '';
    }

    /**
     * @return string
     */
    public function getCityName(): string
    {
        return  $this->response['city'] ?? '';
    }
}
