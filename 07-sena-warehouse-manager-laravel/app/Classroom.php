<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\InsertOnDuplicateKey;

class Classroom extends Model
{

    use InsertOnDuplicateKey;

    protected $fillable = [
        'nombre_ambiente',
        'tipo_ambiente',
        'movilidad',
        'estado',
        'cupo',
        'imagen',
        'disponibilidad',
        'prestado_en',
        'instructor_id',
        'class_group_id',
    ];


    public function instructor() {
    	return $this->belongsTo('App\Instructor');
    }
    public function historyrecords() {
    	return $this->hasMany('App\HistoryRecord');
    }
    public function classgroup() {
        return $this->belongsTo('App\ClassGroup', 'class_group_id');
    }

    public function scopeNombre_ambiente($query, $nombre_ambiente)
    {
        if (trim($nombre_ambiente) != ' ') {
            $query->where('nombre_ambiente', 'LIKE', "%$nombre_ambiente%");
        }
    }
}
