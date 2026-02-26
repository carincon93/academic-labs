@foreach($query as $ins)

    @if($ins->disponibilidad == "disponible")
        <input type="hidden" value="{{ $ins-> id}}" name="instructor_id">
        <div class="text-center">

        </div>
        <h5>Nombre Instructor</h5>
        <p class="text-capitalize h2">{{ $ins->nombre.' '.$ins->apellidos }}</p>
        <h5>Área / Especialidad</h5>
        <p class="text-capitalize h2">{{ $ins->area }}</p>
        {{-- <div class="row">
            <div class="col-md-8">
                <div class="card-instructor">

                </div>
            </div>
            <div class="col-md-4">
                <img src="{{ asset($ins->imagen) }}" alt="" class="img-responsive">
            </div>
        </div> --}}
    @else
        <h3>Este instructor ya tiene un ambiente asignado: <br>
            {{ $ins->classroom->nombre_ambiente }}
        </h3>
    @endif

@endforeach
