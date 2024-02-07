<?php

namespace App\Services;

use GuzzleHttp\Client;

class CurrencyService
{
    public function getCurrencyData(): array
    {
        $client = new Client();
        $response = $client->get('https://www.tcmb.gov.tr/kurlar/today.xml');
        $content = $response->getBody()->getContents();

        $xml = simplexml_load_string($content);

        $usdBuyingRate = $xml->Currency[0]->BanknoteBuying;
        $usdSellingRate = $xml->Currency[0]->ForexSelling;

        $euroBuyingRate = $xml->Currency[3]->BanknoteBuying;
        $euroSellingRate = $xml->Currency[3]->ForexSelling;

        return [
            'usdBuyingRate' => $usdBuyingRate,
            'usdSellingRate' => $usdSellingRate,
            'euroBuyingRate' => $euroBuyingRate,
            'euroSellingRate' => $euroSellingRate,
        ];
    }
}