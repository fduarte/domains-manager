<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Domain
 * @package App
 */
class Domain extends Model
{

    protected $fillable = ['domain_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
