<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClassroomRequest;

use Illuminate\Support\Facades\Schema;

use App\Classroom;

class ClassroomController extends Controller
{
    protected $dataClassroom = [];

    public function __construct()
    {
        $this->middleware('auth')->except('prestamo_aprobado', 'entrega_aprobado', 'obtener_ambiente');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataClassroom = Classroom::all()->sortBy('nombre_ambiente');
        return view('classrooms.index')
            ->with('dataClassroom', $dataClassroom);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassroomRequest $request)
    {
        $dataClassroom = new Classroom();
        $dataClassroom->nombre_ambiente   = $request->get('nombre_ambiente');
        $dataClassroom->tipo_ambiente     = $request->get('tipo_ambiente');
        $dataClassroom->movilidad         = $request->get('movilidad');
        $dataClassroom->estado            = $request->get('estado');
        $dataClassroom->cupo              = $request->get('cupo');
        if ($request->hasFile('imagen')) {
            $file = time().'.'.$request->imagen->getClientOriginalExtension();
            $request->imagen->move(public_path('/images/classrooms/'), $file);
            $dataClassroom->imagen = '/images/classrooms/'.$file;
        }
        if ($dataClassroom->save()){
            return redirect('/admin/classroom')->with('status', 'El ambiente '.$dataClassroom->nombre_ambiente.' fue adicionado con éxito');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('classrooms.show')->with('classroom', classroom::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataClassroom = Classroom::findOrFail($id);
            return view('classrooms.edit')->with('clr', $dataClassroom);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassroomRequest $request, $id)
    {
        $dataClassroom = Classroom::findOrFail($id);
        $dataClassroom->nombre_ambiente = $request->get('nombre_ambiente');
        $dataClassroom->tipo_ambiente   = $request->get('tipo_ambiente');
        $dataClassroom->movilidad       = $request->get('movilidad');
        $dataClassroom->estado          = $request->get('estado');
        $dataClassroom->cupo            = $request->get('cupo');
        if ($request->hasFile('imagen')) {
            \File::delete(public_path($dataClassroom->imagen));
            $file = time().'.'.$request->imagen->getClientOriginalExtension();
            $request->imagen->move(public_path('/images/classrooms/'), $file);
            $dataClassroom->imagen = '/images/classrooms/'.$file;
        }
        if ($dataClassroom->save()) {
            return redirect('/admin/classroom')->with('status', 'El ambiente '.$dataClassroom->nombre_ambiente.' fue modificado con éxito!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Classroom::destroy($id);
        return redirect('/admin/classroom')->with('status', 'El ambiente fue eliminado con éxito');
    }

    public function truncate()
    {
        Schema::disableForeignKeyConstraints();
        Classroom::truncate();
        Schema::enableForeignKeyConstraints();
        return redirect('/admin/classroom')->with('status', 'Todos los registros de las fichas fueron eliminadas con éxito!');
    }

    // Aprobar préstamo y cambiar disponibilidad del ambiente
    public function prestamo_aprobado(Request $request)
    {
        $dataClassroom = Classroom::findOrFail($request->id);
        $dataClassroom->disponibilidad = 'no disponible';
        $dataClassroom->prestado_en    = $request->get('prestado_en');
        $dataClassroom->class_group_id  = $request->get('class_group_id');
        $dataClassroom->instructor_id  = $request->get('instructor_id');


        if($dataClassroom->save()) {
            session()->flash('status', 'El ambiente '.$dataClassroom->nombre_ambiente.' fue asignado con éxtio!');
            return redirect('/');
        }
    }

    public function entrega_aprobado(Request $request)
    {
        $dataClassroom = Classroom::findOrFail($request->id);
        $dataClassroom->disponibilidad = 'disponible';
        $dataClassroom->instructor_id  = NULL;
        $dataClassroom->class_group_id  = NULL;

        if($dataClassroom->save()) {
            $request->session()->flash('status', 'El ambiente '.$dataClassroom->nombre_ambiente.' está disponible nuevamente!');
            return redirect('/');
        }
    }

    public function obtener_ambiente(Request $request)
    {
        $query = Classroom::Nombre_ambiente($request->get('nombre_ambiente'))->orderBy('id', 'ASC')->get();
        return view('classrooms.ajax')->with('query', $query);
    }
}
