<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use SoftDeletes;

    public $table = 'devices';

    protected $hidden = [
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'mac_address','ip_address','area_id'
    ];

  public function Area(){
    return $this->hasOne('App\Area','id','area_id');
  }

}
