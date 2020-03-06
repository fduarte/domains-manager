<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Domain
 * @package App
 */
class Domain extends Model
{

    protected $fillable = [
        'domain_name',
        'client_id'
    ];

    protected $casts = [
        'domain_expires_date' => 'datetime:Y-m-d',
        'domain_created_date' => 'datetime:Y-m-d',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
