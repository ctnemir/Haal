<?php

namespace App\Http\Controllers;

use App\Models\ConfirmMoney;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmMoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('admin')) {
            return view('moneyRequest.index');
        }
        else{abort(403);}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $confirm = ConfirmMoney::find($request->id);
        $user = User::find($confirm->user->id);

        if ($confirm->currency != "TL"){
            $JSON = json_decode(file_get_contents('https://api.genelpara.com/embed/para-birimleri.json'), true);
            $currencies = collect($JSON);
            $currencies->each(function ($item,$key) use ($confirm) {
                if ($key == $confirm->currency)
                {
                    $confirm->amount *= $item["satis"];
                    return false;
                }
            });
        }

        if(!$request->is_request){
            abort(400);
        }

        $user->money += $confirm->amount;
        $user->save();
        $confirm->confirm_at = now();
        $confirm->save();
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

        if(!$request->is_request){
            abort(400);
        }
        $confirmMoney = new ConfirmMoney;
        $confirmMoney->user_id = $request->user_id;
        $confirmMoney->amount = $request->amount;
        if ($request->currency != null){
            $confirmMoney->currency = $request->currency;
        }
        $confirmMoney->save();
        return response()->json("success", 200);
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
}
