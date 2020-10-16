<?php

namespace Nomikz\NationalBankRates;

interface NationalBankApiInterface
{
    public function getAll(): array;

    public function getByCurrency(string $currency): int;

    public function getAllCurrencies(): array;
}
