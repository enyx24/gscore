<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'diem';
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = null;
    protected $keyType = 'string';

    protected $fillable = [
        'sbd',
        'mon',
        'diem',
        'ma_ngoai_ngu',
    ];
}
