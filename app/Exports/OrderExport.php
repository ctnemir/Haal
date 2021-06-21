<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;

class OrderExport implements FromCollection,ShouldAutoSize
{
    public $startTime  = null;
    public $endTime    = null;
    public $kind  = null;
    public $type    = null;

    public function __construct($data)
    {
        $this->startTime = $data['start'];
        $this->endTime = $data['end'];
        $this->kind = $data["kind"];
        $this->type = $data['type'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//        $data = Order::all();
//        $data->prepend((object)['ID','Order Reference','BuyerID','SellerID','Price','Quantity','KindID','CreatedAt','Updated_at']);
//        return $data;
        if ($this->type == 'buying'){
            $data = Order::where('buyer',Auth::user()->id)->get();
        }
        elseif ($this->type == 'selling'){
            $data = Order::where('seller',Auth::user()->id)->get();
        }
        elseif ($this->type == 'all'){
            $data = Order::all();
        }

        else{
            $data1 = Order::where('seller',Auth::user()->id)->get();
            $data2 = Order::where('buyer',Auth::user()->id)->get();
            $data = $data1->merge($data2);
        }

        if ($this->startTime != null && $this->endTime != null) {
            $data = $data->whereBetween('created_at', [$this->startTime, $this->endTime]);
        }
        if ($this->kind != null){
            $data = $data->where('kind_id',$this->kind);
        }
        $data = $data->makeHidden(['id']);
        $data->each(function ($item,$key){
            $item->buyer = $item->getBuyer->name;
            $item->seller = $item->getSeller->name;
            $item->price = "₺".$item->price;
            $item->quantity = $item->quantity." Kg";
            $item->kind_id = $item->kind->name;
        });
        $data->prepend((object)['Order Reference','Buyer','Seller','Price','Quantity','Item','CreatedAt','Updated_at']);

        return $data;
    }
}
