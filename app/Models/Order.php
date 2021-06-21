<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    static function buy($request){


        //tek seferde yapılan emirlerin referansları aynı olacak
        $ref = rand(100000,999999);

        $order_datas = Order::calc($request);

        if (!isset($order_datas->last()["total_price"])){
            return "Pricing Failed";
        }

        if ($request->price < $order_datas->last()["total_price"]){
            $response[0] = "false";
            return  $response;
        }

        if(Auth::user()->money < $order_datas->last()['total_price']){
            $response[0] = "not_enough";
            return response()->json($response, 202);
        }
        foreach ($order_datas as $order_data){
            $order = new Order;
            $order->order_reference = $ref;
            $order->buyer = Auth::user()->id;
            $order->seller = $order_data['user_id'];
            $order->price = $order_data['this_price'];
            $order->quantity = $order_data['used_quantity'];
            $order->kind_id = $order_data['kind_id'];
            $order->save();

            if($order_data['quantity'] == $order_data['used_quantity']){
                Item::destroy($order_data['id']);
                $response[1] = 'out';
                $response[2] = Item::all()->count();
            }
            elseif ($order_data['quantity'] > $order_data['used_quantity']){
                $item = Item::find($order_data['id']);
                $item->quantity -= $order_data['used_quantity'];
                $item->save();
            }
        }

        $seller = User::find($order->seller);
        $seller->money += $order_datas->last()['total_price'];
        $seller->save();

        $admin = User::where('role', 'admin')->first();
        $admin->money += $order_datas->last()['total_price'] * 0.01;

        $buyer = User::find(Auth::user()->id);
        $buyer->money -= $order_datas->last()['total_price'] * 1.01;
        $buyer->save();
        $response[0] = "success";
        return $response;
    }
}
