<?php

namespace App\Console\Commands\Currency;

use Illuminate\Console\Command;
use App\Services\CurrencyService;

class SaveDbCurrencyRate extends Command
{
    
    protected $signature = 'currency:save';
    protected $description = 'Bu komut ile döviz kurlarını veritabanına kaydetebilirsiniz';

    public function handle()
    {
        $currencyService = new CurrencyService();
        $currencyData = $currencyService->getCurrencyData();
        
    }
}
