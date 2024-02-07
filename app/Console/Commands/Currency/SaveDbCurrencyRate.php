<?php

namespace App\Console\Commands\Currency;

use App\Models\Currency;
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

        $today = date('Y-m-d');
        Currency::updateOrCreate(
            ['name' => 'usd', 'date' => $today],
            [ 
                'selling_rate' => $currencyData['usdSellingRate'],
                'buying_rate' => $currencyData['usdBuyingRate'],
                'date' => $today
            ]
        );

        Currency::updateOrCreate(
            ['name' => 'euro', 'date' => $today], 
            [ 
                'selling_rate' => $currencyData['euroSellingRate'],
                'buying_rate' => $currencyData['euroBuyingRate'],
                'date' => $today
            ]
        );

        $this->info('Döviz kurları başarıyla güncellendi.');
    }
}
