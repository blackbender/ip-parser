<?php

namespace App\Services\IpParser;

use App\Services\IpParser\Adapters\Interfaces\ParserAdapterInterface;
use App\Services\IpParser\Repositories\Interfaces\IpParserRepositoryInterface;

/**
 *
 */
class IpParserService implements Interfaces\IpParserServiceInterface
{
    /**
     * @var ParserAdapterInterface
     */
    private $adapter;
    /**
     * @var IpParserRepositoryInterface
     */
    private $repository;
    /**
     * @var string
     */
    private string $ip;

    /**
     * @param ParserAdapterInterface $adapter
     * @param IpParserRepositoryInterface $repository
     */
    public function __construct(ParserAdapterInterface $adapter, IpParserRepositoryInterface $repository)
    {
        $this->adapter = $adapter;
        $this->repository = $repository;
    }

    /**
     * @param string $ip
     * @return bool
     */
    public function parse(string $ip): bool
    {
        $this->ip = $ip;
        return $this->adapter->parse($ip);
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->adapter->getCountryCode();
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->adapter->getCountryName();
    }

    /**
     * @return string
     */
    public function getCityName(): string
    {
        return $this->adapter->getCityName();
    }

    /**
     * @param int $linkId
     * @return bool
     */
    public function save(int $linkId): bool
    {
        return $this->repository->save([
            'link_id' => $linkId,
            'ip' => $this->ip,
            'country_code' => $this->getCountryCode(),
            'country_name' => $this->getCountryName(),
            'city_name' => $this->getCityName()
        ]);
    }
}
