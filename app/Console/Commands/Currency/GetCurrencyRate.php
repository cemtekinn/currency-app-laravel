<?php

namespace App\Console\Commands\Currency;
use Illuminate\Console\Command;
use App\Services\CurrencyService;

class GetCurrencyRate extends Command
{
    protected $signature = 'currency:show';
    protected $description = 'Bu komut ile döviz verilerini konsola yazdırabilirsiniz';

    public function handle()
    {
        $currencyService = new CurrencyService();
        $currencyData = $currencyService->getCurrencyData();
        $this->info('-----------Merkez bankası verileri---------------');
        $this->info('USD Alış Kuru: ' . $currencyData['usdBuyingRate'] . " TL");
        $this->info('USD Satış Kuru: ' . $currencyData['usdSellingRate'] . " TL");
        $this->info('--------------------------------------------');
        $this->info('EURO Alış Kuru: ' . $currencyData['euroBuyingRate'] . " TL");
        $this->info('EURO Satış Kuru: ' . $currencyData['euroSellingRate'] . " TL");
        $this->info('--------------------------------------------');
    }
}
