<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Item;
use App\Models\Order;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Kind;
use Illuminate\Support\Facades\Auth;

class DashChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $orders= Order::where('buyer','=',Auth::user()->id)
            ->where('quantity','>',0)
            ->get()
            ->sortBy('id');

        $k = array();
        foreach ($orders as $order){
            array_push($k,$order->kind->name);
        }


        $q = array();
        foreach ($orders->groupBy('kind_id') as $order){
            array_push($q,strval($order->sum('quantity')));
        }



        return Chartisan::build()
            /*->labels(array_unique($k))
            ->dataset('Kg',$q)
            */
            ->labels(array_values(array_unique($k)))
            ->Dataset('kg',$q)
            ;
    }//
}
