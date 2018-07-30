<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $fillable = ['studentid','in_am','out_am','in_pm','out_pm','date', 'totalhrs'];
}
