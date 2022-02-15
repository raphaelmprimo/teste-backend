<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Access extends Model
{

    use SoftDeletes;
 
    protected $table = 'access';

    protected $primaryKey = 'id';

    protected $fillable = [
        'link_id', 'ip', 'user_agent'
    ];

}
