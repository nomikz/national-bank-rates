<?php

namespace Nomikz\NationalBankRates;

class NationalBankApi
{
    public function getAllRates()
    {
        $objectXmlResponse = $this->nationalBankApiRequest();
        $rawRates = $this->extractRatesFrom($objectXmlResponse);
        return $this->mapToCorrectFormat($rawRates);
    }

    private function nationalBankApiRequest(): \SimpleXMLElement
    {
        $xmlUrl = config('nationalbankrates.national_bank_api_url');
        $xmlString = file_get_contents($xmlUrl);
        return simplexml_load_string($xmlString);
    }

    private function extractRatesFrom($objectXmlDocument): array
    {
        $arrayXml = json_decode(json_encode($objectXmlDocument), true);

        return $arrayXml['channel']['item'];
    }

    private function mapToCorrectFormat($rawRates): array
    {
        return collect($rawRates)
            ->map(function ($rate) {
                $oneKzt = $rate['description'] / $rate['quant'];

                if (config('nationalbankrates.show_in_cents')) {
                    $oneKzt = $oneKzt * 100; // перевод в тиын
                }

                return [
                    'currency' => $rate['title'],
                    'value' => $oneKzt,
                ];
            })
            ->toArray();
    }
}
