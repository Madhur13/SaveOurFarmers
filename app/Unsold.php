<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unsold extends Model
{
    //
    protected $table='unsolds';
    protected $primaryKey = 'id'; // or null

    public $incrementing = false;
}
