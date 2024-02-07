<?php

namespace App\Console\Commands\Currency;

use Illuminate\Console\Command;
use App\Services\CurrencyService;

class GetCurrencyRateByDate extends Command
{
    protected $signature = 'currency:get {date?}';
    protected $description = 'Bu komut ile döviz verilerini konsola yazdırabilirsiniz';

    public function handle()
    {
        $currencyService = new CurrencyService();
        $date = $this->argument('date');
        $date = $date ? $date : date('Y-m-d');
        $currencyData = $currencyService->getCurrencyDataFromDatabase($date);
        $this->info('---------------- '.$date.' --------------');
        $this->info('USD Alış Kuru: ' . $currencyData['usdBuyingRate']);
        $this->info('USD Satış Kuru: ' . $currencyData['usdSellingRate']);
        $this->info('--------------------------------------------');
        $this->info('EURO Alış Kuru: ' . $currencyData['euroBuyingRate']);
        $this->info('EURO Satış Kuru: ' . $currencyData['euroSellingRate']);
        $this->info('--------------------------------------------');
    }
}
