<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ownership extends Model
{
    //
    protected $table='ownersships';
    protected $primaryKey = 'id'; // or null

    public $incrementing = false;
}
