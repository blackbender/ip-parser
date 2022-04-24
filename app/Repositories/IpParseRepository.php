<?php

namespace App\Services\IpParser\Repositories;

use App\Models\Statistic;

/**
 *
 */
class IpParseRepository implements Interfaces\IpParserRepositoryInterface
{

    /**
     * @param array $data
     * @return bool
     */
    public function save(array $data): bool
    {
        if(Statistic::where('link_id', $data['link_id'])->where('ip', $data['ip'])->first()){
            return false;
        }

        $statistic = new Statistic;
        $statistic->link_id = $data['link_id'];
        $statistic->ip = $data['ip'];
        $statistic->country_code = $data['country_code'];
        $statistic->country_name = $data['country_name'];
        $statistic->city_name = $data['city_name'];

        return $statistic->save();
    }
}
