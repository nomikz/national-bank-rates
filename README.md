# National Bank Rates
This is a simple laravel package that lets you get the the KZT rates from national bank api.

## Installation
You can install it easily by composer. 
```
composer require nomikz/national-bank-rates
```

## Usage
```
use Nomikz\NationalBankRates\Facades\NationalBankRates;

NationalBankRates::getAll();
NationalBankRates::getByCurrency('usd');
NationalBankRates::getAllCurrencies();
```
Only three methods are avaliable in the interface.


## Details
There is caching functionality in the package. After making first request to the api, rates will be cached by laravel Cache service.
National bank updates rates every day so there is check. Cache gets updated each day.
