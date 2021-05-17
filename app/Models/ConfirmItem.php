<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ConfirmItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'is_new_kind ' , 'new_kind' , 'kind_id', 'quantity', 'is_on_sale',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getKind(){
        return $this->hasOne(Kind::class,'id','kind_id');
    }
}
