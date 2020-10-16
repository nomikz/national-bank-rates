<?php

namespace Nomikz\NationalBankRates;

class NationalBankRates implements NationalBankApiInterface
{
    private $rates;

    public function __construct(NationalBankApi $nationalBankApi, Cacher $cacher)
    {
        if (!$cacher->has('rates')) {
            $rates = $nationalBankApi->getAllRates();

            $cacher->put('rates', $rates);
        }

        $this->rates = collect($cacher->get('rates'));
    }

    public function getAll(): array
    {
        return $this->rates->toArray();
    }

    public function getByCurrency(string $currency): int
    {
        $oneUnitInKzt = $this
            ->rates
            ->first(function ($rate) use ($currency) {
                $currency = strtoupper(trim($currency));
                return $rate['currency'] === $currency;
            });

        return (int)$oneUnitInKzt['value'];
    }

    public function getAllCurrencies(): array
    {
        return $this
            ->rates
            ->pluck('currency')
            ->toArray();
    }
}
