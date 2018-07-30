<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = ['photo','studno', 'batch', 'fname', 'lname', 'bday', 'jobexp', 'contact', 'email', 'attainment', 'school', 'nickname', 'sched_in', 'sched_out'];

    public function batch(){
        return $this->belongsTo('App\Batch');
    }


}


