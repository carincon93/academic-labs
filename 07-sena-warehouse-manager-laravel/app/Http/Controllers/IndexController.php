<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classroom;
use App\Instructor;
use App\HistoryRecord;
use App\ClassGroup;

class IndexController extends Controller
{
    protected $dataClassroom = [];
    protected $dataHistoryR = [];
    protected $dataInstructor = [];
    protected $dataFicha = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataClassroom  = Classroom::orderByDesc('disponibilidad')->get();
        $dataHistoryR   = HistoryRecord::orderByDesc('prestado_en', 'DESC')->take(5)->get();
        $dataInstructor = Instructor::all()->sortBy('nombre');
        $dataFicha          = ClassGroup::where('disponibilidad', '=', 'disponible')->get();

        return view('index', compact('dataClassroom', 'dataHistoryR', 'dataInstructor', 'dataFicha'));
    }
}
