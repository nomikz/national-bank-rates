<?php

namespace Nomikz\NationalBankRates;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Cacher
{
    const PREFIXER = 'nomikz.';

    public function get(string $key)
    {
        $cacheString = Cache::get(static::PREFIXER .  $key);

        return json_decode($cacheString, true);
    }

    public function has(string $key)
    {
        return Cache::has(static::PREFIXER . $key);
    }

    public function put(string $key, array $rates)
    {
        $shouldBeCached = $this->shouldBeCached();

        if ($shouldBeCached) {
            $stringifiedData = json_encode($rates);
            Cache::put(static::PREFIXER . $key, $stringifiedData);
            Cache::put(static::PREFIXER . 'date', Carbon::now()->toDateString());
        }
    }

    private function shouldBeCached()
    {
        if(!Cache::has('date')) {
            return true;
        }

        $today = Carbon::now()->toDateString();

        if ($today !== Cache::get('date')) {
            return true;
        }

        return false;
    }
}
