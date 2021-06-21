<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRequest extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class,'user_id','id');
    }
    public function kind(){
        return $this->belongsTo(Kind::class,'kind_id');
    }
    static function check(){
        $data= static::where('executed_at' , null)->get();
        $data->each(function ($item,$key){
            $status = Order::buy($item);
            echo $status[0];
            if ($status[0] == "success"){
            $item->executed_at = now();
            $item->save();}
        });
    }
}
