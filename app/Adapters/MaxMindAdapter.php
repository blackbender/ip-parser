<?php

namespace App\Services\IpParser\Adapters;

use GeoIp2\Database\Reader;
use GeoIp2\Model\City;

class MaxMindAdapter implements Interfaces\ParserAdapterInterface
{

    /**
     * @var Reader
     */
    private Reader $reader;
    /**
     * @var City
     */
    private City $record;

    /**
     * @param string $ip
     * @return bool
     * @throws \GeoIp2\Exception\AddressNotFoundException
     * @throws \MaxMind\Db\Reader\InvalidDatabaseException
     */
    public function parse(string $ip): bool
    {
        $this->reader = new Reader('/var/www/html/app/resources/geo/GeoLite2-City.mmdb');
        $this->record = $this->reader->city($ip);
        $this->ip = $ip;

        return true;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return   $this->record->country->isoCode ?? '';
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return   $this->record->country->name ?? '';
    }

    /**
     * @return string
     */
    public function getCityName(): string
    {
        return   $this->record->city->name ?? '';
    }
}
