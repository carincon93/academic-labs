<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InstructorRequest;
use Illuminate\Validation\Rule;

use App\Instructor;

class InstructorController extends Controller
{
    protected $dataInstructor = [];

    public function __construct()
    {
        $this->middleware('auth')->except('disponibilidad_instructor', 'modificar_disponibilidad', 'ajax');
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $dataInstructor = Instructor::all()->sortBy('nombre');
        return view('instructors.index')->with('dataInstructor', $dataInstructor);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('instructors.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(InstructorRequest $request)
    {
        $dataInstructor = new Instructor();
        $dataInstructor->nombre            = $request->get('nombre');
        $dataInstructor->apellidos         = $request->get('apellidos');
        $dataInstructor->vinculacion1      = $request->get('vinculacion1');
        $dataInstructor->numero_documento  = $request->get('numero_documento');
        $dataInstructor->area              = $request->get('area');
        $dataInstructor->ip                = $request->get('ip');
        $dataInstructor->celular           = $request->get('celular');
        $dataInstructor->email             = $request->get('email');

        if ($request->hasFile('imagen')) {
            $file = time().'.'.$request->imagen->getClientOriginalExtension();
            $request->imagen->move(public_path('/images/instructors/'), $file);
            $dataInstructor->imagen = '/images/instructors/'.$file;
        }

        if ($dataInstructor->save()){
            return redirect('/admin/instructor')
            ->with('status', 'El instructor '.$dataInstructor->nombre.' '.$dataInstructor->apellidos.' fue adicionado con éxito');
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
        $dataInstructor  = Instructor::findOrFail($id);
        return view('instructors.show')
        ->with('dataInstructor', $dataInstructor);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $dataInstructor  = Instructor::findOrFail($id);
        return view('instructors.edit')
        ->with('dataInstructor', $dataInstructor);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(InstructorRequest $request, $id)
    {
        $dataInstructor = Instructor::findOrFail($id);
        $this->validate($request, [
            'numero_documento' => [
                'required',
                Rule::unique('instructors')->ignore($dataInstructor->id),
            ],
            'email' => [
                'required',
                Rule::unique('instructors')->ignore($dataInstructor->id),
            ]
        ]);
        $dataInstructor->nombre               = $request->get('nombre');
        $dataInstructor->apellidos            = $request->get('apellidos');
        $dataInstructor->vinculacion1         = $request->get('vinculacion1');
        $dataInstructor->area                 = $request->get('area');
        $dataInstructor->numero_documento     = $request->get('numero_documento');
        $dataInstructor->ip                   = $request->get('ip');
        $dataInstructor->celular              = $request->get('celular');
        $dataInstructor->email                = $request->get('email');
        if ($request->hasFile('imagen')) {
            $file = time().'.'.$request->imagen->getClientOriginalExtension();
            $request->imagen->move(public_path('/images/instructors/'), $file);
            $dataInstructor->imagen = '/images/instructors/'.$file;
        }
        if ($dataInstructor->save()){
            return redirect('admin/instructor')
            ->with('status', 'El instructor '.$dataInstructor->nombre.' '.$dataInstructor->apellidos.' fue modificado con éxito');
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
        Instructor::destroy($id);
        return redirect('/admin/instructor')
        ->with('status', 'El instructor fue eliminado con éxito');
    }

    public function disponibilidad_instructor(Request $request, $id_instructor)
    {
        $dataInstructor = Instructor::where('id', '=', $id_instructor)->first();
        $dataInstructor->disponibilidad = "no disponible";
        $dataInstructor->save();
    }

    public function modificar_disponibilidad(Request $request, $id_instructor)
    {
        $dataInstructor = Instructor::where('id', '=', $id_instructor)->first();
        $dataInstructor->disponibilidad = "disponible";
        $dataInstructor->save();
    }

    public function ajax(Request $request)
    {
        $query = Instructor::numero_documento($request->get('numero_documento'))->get();
        return view('ajax.instructors', compact('query'));

    }
}
