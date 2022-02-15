<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{

    use SoftDeletes;

    protected $table = 'links';

    protected $primaryKey = 'id';

    protected $fillable = [
        'url', 'slug', 'total_access'
    ];

    /**
     * Scope a query to get the link by slug.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeGetBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }


}
