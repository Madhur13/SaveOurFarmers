<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table='products';
    protected $primaryKey = 'id'; // or null
     public $fillable=['name','category','base_price','winning_price','quantity','date','time'];
    
}
