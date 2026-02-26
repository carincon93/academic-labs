<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Requests\ClassGroupRequest;


use App\ClassGroup;
use App\Instructor;

class ClassGroupController extends Controller
{
    protected $dataClassGroup = [];

    public function __construct()
    {
        $this->middleware('auth')->except('disponibilidad_classgroup', 'modificar_disponibilidad');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataClassGroup  = ClassGroup::all()->sortBy('nombre_ficha');
        return view('class_groups.index')->with('dataClassGroup', $dataClassGroup );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataInstructor = Instructor::all()->sortBy('nombre');
        return view('class_groups.create')->with('dataInstructor', $dataInstructor);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassGroupRequest $request)
    {
        $dataClassGroup = new ClassGroup();
        $dataClassGroup->id_ficha       = $request->get('id_ficha');
        $dataClassGroup->nombre_ficha   = $request->get('nombre_ficha');
        $dataClassGroup->instructor_id  = $request->get('instructor_id');
        $dataClassGroup->tipo_formacion = $request->get('tipo_formacion');
        if ($dataClassGroup->save()){
            return redirect('/admin/class_group')->with('status', 'La ficha '.$dataClassGroup->nombre_ficha.' fue adicionada con éxito');
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

        return view('class_groups.show')->with('dataClassGroup', ClassGroup::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataInstructor = Instructor::all()->sortBy('nombre');
        $dataClassGroup = ClassGroup::findOrFail($id);
        return view('class_groups.edit')
            ->with('dataClassGroup', $dataClassGroup)->with('dataInstructor', $dataInstructor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassGroupRequest $request, $id)
    {
        $dataClassGroup = ClassGroup::findOrFail($id);
        $this->validate($request, [
            'id_ficha' => [
                'required',
                Rule::unique('class_groups')->ignore($dataClassGroup->id),
            ]
        ]);
        $dataClassGroup->id_ficha       = $request->get('id_ficha');
        $dataClassGroup->nombre_ficha   = $request->get('nombre_ficha');
        $dataClassGroup->instructor_id  = $request->get('instructor_id');
        $dataClassGroup->tipo_formacion = $request->get('tipo_formacion');
        if ($dataClassGroup->save()){
            return redirect('/admin/class_group')->with('status', 'La ficha '.$dataClassGroup->nombre_ficha.' fue modificado con éxito');
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
        ClassGroup::destroy($id);
        return redirect('/admin/class_group')->with('status', 'La ficha fue eliminada con éxito');
    }

    public function truncate()
    {
        ClassGroup::truncate();
        return redirect('/admin/class_group')->with('status', 'Todos los registros de las fichas fueron eliminadas con éxito!');
    }
    public function disponibilidad_classgroup(Request $request, $class_group_id)
    {
        $dataClassGroup = ClassGroup::where('id', '=', $class_group_id)->first();
        $dataClassGroup->disponibilidad = "no disponible";
        $dataClassGroup->save();
    }

    public function modificar_disponibilidad(Request $request, $class_group_id)
    {
        $dataClassGroup = ClassGroup::where('id', '=', $class_group_id)->first();
        $dataClassGroup->disponibilidad = "disponible";
        $dataClassGroup->save();
    }
}
