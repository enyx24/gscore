<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'score';
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = null;
    protected $keyType = 'string';

    protected $fillable = [
        'uid',
        'subject',
        'score',
        'foreign_language_id',
    ];
}
