<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'is_confirmed', 'kind_id', 'quantity', 'is_on_sale','price',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function getKind(){
        return $this->hasOne(Kind::class,'id','kind_id');
    }

}
