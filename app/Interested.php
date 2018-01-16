<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interested extends Model
{
    //
    protected $table='interesteds';
    protected $primaryKey = 'id'; // or null

    public $incrementing = false;
}
