<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasNameSlug;

class Category extends Model
{
    use HasNameSlug;
    
    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The orders that belong to the report.
     * 
     * @var Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
