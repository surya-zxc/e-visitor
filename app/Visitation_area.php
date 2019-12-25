<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Visitation_area extends Model
{
    use SoftDeletes;

    public $table = 'visitation_allowed_areas';

    protected $hidden = [
    ];

    protected $dates = [
        'timetamp',
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'visitation_id','area_id'
    ];
}
