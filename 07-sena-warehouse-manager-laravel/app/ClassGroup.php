<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\InsertOnDuplicateKey;

class ClassGroup extends Model
{
    use InsertOnDuplicateKey;

    protected $fillable = [
        'id_ficha', 'nombre_ficha', 'instructor_id', 'tipo_formacion', 'disponibilidad',
    ];

    public function instructor() {
    	return $this->belongsTo('App\Instructor');
    }
    public function historyrecords() {
    	return $this->hasMany('App\HistoryRecord');
    }
    public function classrooms() {
    	return $this->hasMany('App\Classroom');
    }
}
