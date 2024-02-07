<?php

namespace App\Console\Commands\Currency;

use App\Models\CurrencyRate;
use Illuminate\Console\Command;
use App\Services\CurrencyService;

class SaveDbCurrencyRate extends Command
{
    
    protected $signature = 'currency:update';
    protected $description = 'Bu komut ile döviz kurlarını veritabanına kaydetebilirsiniz';

    public function handle()
    {
        $currencyService = new CurrencyService();
        $currencyData = $currencyService->getCurrencyData();

        CurrencyRate::where('name', 'usd')->update([
            'selling_rate' => $currencyData['usdSellingRate'],
            'buying_rate' => $currencyData['usdBuyingRate']
        ]);
    
        CurrencyRate::where('name', 'euro')->update([
            'selling_rate' => $currencyData['euroSellingRate'],
            'buying_rate' => $currencyData['euroBuyingRate']
        ]);
        $this->info('Döviz kurları başarıyla güncellendi.');
    }
}
