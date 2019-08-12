<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    protected $fillable = ['ip', 'country', 'city' , 'link_id'];
}
