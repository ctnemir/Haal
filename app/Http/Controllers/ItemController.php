<?php

namespace App\Http\Controllers;

use App\Models\ConfirmItem;
use App\Models\Item;
use App\Models\Kind;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->is_request){
            abort(400);
        }
        $confirmItem = ConfirmItem::find($request->id);
        $item = new Item;
        if ($confirmItem->is_new_kind){
            $new_kind = new Kind;
            $new_kind->name = $confirmItem->new_kind;
            $new_kind->save();
            $item->kind_id = $new_kind->id;
        }
        else{
            $item->kind_id = $confirmItem->kind_id;
        }

        $item->user_id = $confirmItem->user_id;
        $item->is_confirmed = true;
        $item->quantity = $confirmItem->quantity;
        $item->price = $confirmItem->price;
        $item->is_on_sale = true;
        $item->save();
        $confirmItem->delete();

        return response()->json("success", 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datas = Item::where('is_on_sale','=',true)->get()
        ->groupBy('kind_id');
        //return $datas->first()->first()->getKind;
        return view('item.show')->with('data',$datas);
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
    public function toggle(Request $request){
        //return $request;
        if ($request->status == 'true'){
            return DB::table('items')
                ->where("id" , $request->dataId)
                ->update([
                    'is_on_sale' => false
                ]);
        }
        else{
            return DB::table('items')
                ->where("id" , $request->dataId)
                ->update([
                    'is_on_sale' => true
                ]);
        }
    }
}
