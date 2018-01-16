<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $table='feedbacks';
    protected $primaryKey = 'id'; // or null

    public $incrementing = false;
}
