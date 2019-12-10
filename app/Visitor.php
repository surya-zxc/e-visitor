<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use SoftDeletes;

    public $table = 'visitors';

    protected $hidden = [
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'no_identitas','jenis_identitas','jenis_identitas_lainnya','nama','tempat_lahir','tanggal_lahir',
        'jenis_kelamin','golongan_darah','alamat','no_telp','agama','marital_status','pekerjaan','kewarganegaraan'
    ];

}
