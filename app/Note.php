<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
	use SoftDeletes;
	
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'status',
    ];
}
