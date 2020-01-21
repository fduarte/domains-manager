<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * @package App
 */
class Client extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function domains()
    {
        return $this->hasMany('App\Domain');
    }
}
