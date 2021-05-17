<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kind;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.index');
        $orders = Order::all()->groupBy('order_reference');
        foreach ($orders as $order){
            printf($order->first()->kind->name);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //tek seferde yapılan emirlerin referansları aynı olacak
        $ref = rand();

        $order_datas = Order::calc($request);

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

        $buyer = User::find(Auth::user()->id);
        $buyer->money -= $order_datas->last()['total_price'];
        $buyer->save();
        $response[0] = "success";
        return response()->json($response, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function calc(Request $request){
        //$order = new Order;
        //return Order::calc($request);
        return Order::calc($request)->last()['total_price'];
    }
}
