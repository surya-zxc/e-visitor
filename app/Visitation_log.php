<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Visitation_log extends Model
{
    use SoftDeletes;

    public $table = 'visitations_activity_logs';

    protected $hidden = [
    ];

    protected $dates = [
        'timetamp',
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'visitation_id','area_id',
        'device_id','timestamp'
    ];

    public function area(){
      return $this->hasOne('App\Area','id','area_id');
    }

    public function device(){
      return $this->hasOne('App\Device','id','device_id');
    }

}
