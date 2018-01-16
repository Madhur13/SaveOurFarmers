<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoldTable extends Model
{
    //
    protected $table='solds';
    protected $primaryKey = 'id'; // or null

    public $incrementing = false;
}
