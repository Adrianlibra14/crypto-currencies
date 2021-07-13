<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CryptoController extends Controller
{
    // Function to get the info and pass it to the view
    public function index()
    {
        $get_crypto = Http::get('api.coincap.io/v2/assets?ids=bitcoin,ethereum,tether,binance-coin,cardano'); 

        $get_crypto = $get_crypto['data'];

        // Getting data from coincap
        $bitcoin =      $get_crypto[0];
        $ethereum =     $get_crypto[1];
        $tether =       $get_crypto[2];
        $binance_coin = $get_crypto[3];
        $cardano =      $get_crypto[4];
        
        // Wrap data
        $crypto_exchanges = [
            $bitcoin,
            $ethereum,
            $tether,
            $binance_coin,
            $cardano
        ];

        // Short crypto info data
        for($i = 0; $i < count($crypto_exchanges); $i++){
            $crypto_exchanges[$i]['marketCapUsd'] =     '$' . $this->short_number($crypto_exchanges[$i]['marketCapUsd']);
            $crypto_exchanges[$i]['supply'] =           $this->short_number($crypto_exchanges[$i]['supply']);
            $crypto_exchanges[$i]['volumeUsd24Hr'] =    '$' . $this->short_number($crypto_exchanges[$i]['volumeUsd24Hr']);
            $crypto_exchanges[$i]['priceUsd'] =         '$' . number_format($crypto_exchanges[$i]['priceUsd'], 2);
            $crypto_exchanges[$i]['vwap24Hr'] =         '$' . number_format($crypto_exchanges[$i]['vwap24Hr'], 2);
        }
        
        // Format data to be pass into the view
        $crypto_exchanges = [
            'bitcoin' => $crypto_exchanges[0],
            'ethereum' => $crypto_exchanges[1],
            'tether' => $crypto_exchanges[2],
            'binance_coin' => $crypto_exchanges[3],
            'cardano' => $crypto_exchanges[4]
        ];

        // Returning the view and passing the parameters to it
        return view('app', $crypto_exchanges);
    }

    // Show crypto currency chart
    public function show($crypto)
    {
        $crypto = strtolower($crypto);
        // Show chart view and pass data from url
        return view('chart', ['crypto' => $crypto]);
    }

    // Function to short the number
    private function short_number($n)
    {
        if ($n < 1000000) {
            // Anything less than a million
            $n_format = number_format($n / 1000);
        } else if ($n < 1000000000) {
            // Anything less than a billion
            $n_format = number_format($n / 1000000, 2) . 'M';
        } else {
            // At least a billion
            $n_format = number_format($n / 1000000000, 2) . 'B';
        }
        return $n_format;
    }
}
