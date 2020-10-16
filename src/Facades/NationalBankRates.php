<?php

namespace Nomikz\NationalBankRates\Facades;

use Illuminate\Support\Facades\Facade;

class NationalBankRates extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'nationalbankrates';
    }
}
