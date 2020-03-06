<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'price'
    ];

    public function clients()
    {
        return $this->belongsToMany('App\Client');
    }

}
