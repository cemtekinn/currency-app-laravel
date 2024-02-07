<?php

namespace App\Services;

use App\Models\Currency;
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
    
    public function getCurrencyDataFromDatabase($date=null): array
    {
        $date = $date ? $date: date('Y-m-d');
        $currencyDataUsd = Currency::where('date', $date)->where('name','usd')->first();
        $currencyDataEuro = Currency::where('date', $date)->where('name','euro')->first();
        return [
            'usdBuyingRate' => $currencyDataUsd ? $currencyDataUsd->buying_rate : 'Veri yok',
            'usdSellingRate' => $currencyDataUsd ? $currencyDataUsd->selling_rate : 'Veri yok',
            'euroBuyingRate' => $currencyDataEuro ? $currencyDataEuro->buying_rate : 'Veri yok',
            'euroSellingRate' => $currencyDataEuro ? $currencyDataEuro->selling_rate : 'Veri yok',
        ];
    }
}