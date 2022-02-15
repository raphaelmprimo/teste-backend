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

}
