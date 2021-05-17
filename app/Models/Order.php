<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'buyer', 'order_reference', 'seller', 'price', 'quantity', 'kind_id',
    ];


    public function getBuyer(){
        return $this->belongsTo(User::class,'buyer');
    }

    public function getSeller(){
        return $this->belongsTo(User::class,'seller');
    }

    public function kind(){
        return $this->belongsTo(Kind::class,'kind_id');
    }
    static function calc($request){
        //fiyata göre sıralı ürünleri getir
        $items = Item::where('kind_id' , $request->kind_id)->get()->sortBy('price');
        //Sepet oluştur
        $cart = collect([]);
        //toplam fiyatı sıfırla
        $totalPrice= 0;
        //kalan miktarı istenilen miktara ayarla
        $leftQuantity = $request->quantity;
        foreach ($items as $item) {
            if($leftQuantity > 0){
                if ($leftQuantity >= $item->quantity) {
                    // istenilen miktara ulaşılmadı
                    $cart->push(collect($item));
                    $totalPrice += $item->price * $item->quantity;
                    $leftQuantity = $leftQuantity - $item->quantity;
                    $cart->last()->put('total_price', $totalPrice);
                    $cart->last()->put('this_price', $item->price * $item->quantity);
                    $cart->last()->put('left_quantity', $leftQuantity);
                    $cart->last()->put('used_quantity', $item->quantity);
                } elseif($leftQuantity < $item->quantity) {
                    //istenilen miktardan fazla
                    $cart->push(collect($item));
                    $cart->last()->put('left_quantity', $leftQuantity);
                    $totalPrice += $item->price * $leftQuantity;
                    $cart->last()->put('total_price', $totalPrice);
                    $cart->last()->put('this_price', $item->price * $leftQuantity);
                    $cart->last()->put('left_quantity' , 0);
                    $cart->last()->put('used_quantity', $leftQuantity);
                    break;
                }
            }
            else{break;}
        }
        return $cart;
    }
}
