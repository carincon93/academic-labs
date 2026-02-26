<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryRecord extends Model
{
    protected $fillable = [
        'instructor_id', 'class_group_id','classroom_id', 'prestado_en', 'entregado_en', 'novedad', 'novedad_nueva',
    ];
    public function classgroup() {
        return $this->belongsTo('App\ClassGroup', 'class_group_id');
    }
    public function instructor() {
    	return $this->belongsTo('App\Instructor');
    }
    public function classroom() {
    	return $this->belongsTo('App\Classroom');
    }
    public function scopeId($query, $id)
    {
        $query->where('id', '=', "$id");
    }

    public $timestamps = false;
}
