<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function bestPrice(){
        return Item::where('kind_id' , $this->id)->where('is_on_sale' , true)->min('price');
    }
    public function avaibleQuantity(){
        return Item::where('kind_id' , $this->id)->sum('quantity');
    }
}
