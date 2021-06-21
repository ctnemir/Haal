<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kind;
use App\Models\Order;
use App\Models\OrderRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::all()->groupBy('order_reference');
        return view('order.index')->with('data',$data);
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


        $order_datas = Order::calc($request);
        //istenen ücret uygunsa satın alma işlemi gerçekleşsin
        if ($request->price > $order_datas->last()["total_price"]){
            return response()->json(Order::buy($request), 200);
        }
        else{
            $orderRequest = new OrderRequest;
            $orderRequest->user_id = Auth::user()->id;
            $orderRequest->kind_id = $request->kind_id;
            $orderRequest->quantity = $request->quantity;
            $orderRequest->price = $request->price;
            $orderRequest->save();

            $response[0] =  "orderRecord created";
            return response()->json($response , 200);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Auth::id();
        $data1 = Order::where('seller',$id)->get();
        $data2 = Order::where('buyer',$id)->get();

        //return gettype($data->first()->toArray());
        return view('order.show')
            ->with('selling',$data1)
            ->with('buying',$data2);
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
        //return $request;
        //$order = new Order;
        //return Order::calc($request);
        return Order::calc($request)->last()["total_price"];
    }
    public function export(Request $request){
//        return $request;
        if ($request->start != null || $request->end != null){
            $request = $request->validate([
                'start' => 'required',
                'end' => 'required',
                'kind' => '',
                'type' => ''
            ]);
        }
        return Excel::download(new OrderExport($request), 'order.xlsx');
    }
}
