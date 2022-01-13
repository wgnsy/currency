<?php

namespace Wgnsy\Currency\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Wgnsy\Currency\app\Models\Currency;
use Wgnsy\Currency\app\Models\CurrencyDetails;


class DatabaseSeeder extends Seeder {

    public function run()
    {
        
        CurrencyDetails::query()->delete();
        Currency::query()->delete();
        
        $currencies = config('currency.currencies');
        $start_date = config('currency.start_date');
        $end_date = config('currency.end_date');

        foreach($currencies as $currency){
            Currency::create(['code' => $currency]);
        }
        $currenciesDetails = [];
        foreach($currencies as $currency){
            $array = Http::get('http://api.nbp.pl/api/exchangerates/rates/A/'.$currency.'/'.$start_date.'/'.$end_date.'/');
            $array = $array->json();
            foreach($array['rates'] as $key => $rate){
                $currenciesDetails[$currency][$key]['date'] = $rate['effectiveDate'];
                $currenciesDetails[$currency][$key]['mid'] = $rate['mid'];
               
            }
        }
        foreach($currencies as $currency){
            $array = Http::get('http://api.nbp.pl/api/exchangerates/rates/C/'.$currency.'/'.$start_date.'/'.$end_date.'/');
            $array = $array->json();
            foreach($array['rates'] as $key => $rate){
                $currenciesDetails[$currency][$key]['bid'] = $rate['bid'];
                $currenciesDetails[$currency][$key]['ask'] = $rate['ask'];
            }
        }
     
        foreach($currenciesDetails as $code => $details){
            foreach($details as $detail){
                $id = Currency::where('code',$code)->first()->id;
                $detail['currency_id'] = $id;
                CurrencyDetails::create($detail);
            }
        }

        $this->command->info('Currency table seeded!');
    }

}

