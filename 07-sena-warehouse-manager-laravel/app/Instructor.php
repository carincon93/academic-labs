<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\InsertOnDuplicateKey;

class Instructor extends Model
{
    use InsertOnDuplicateKey;

    protected $fillable = [
        'nombre',
        'apellidos',
        'numero_documento',
        'area',
        'ip',
        'celular',
        'email',
        'imagen',
        'disponibilidad',
    ];

    public function classgroups() {
    	return $this->hasMany('App\ClassGroup');
    }
    public function classroom() {
    	return $this->hasOne('App\Classroom');
    }
    public function historyrecords() {
    	return $this->hasMany('App\HistoryRecord');
    }

    public function scopeNumero_documento($query, $numero_documento)
    {
        if (trim($numero_documento) != '') {
            $query->where('numero_documento', '=', "$numero_documento");
        }
    }
}
