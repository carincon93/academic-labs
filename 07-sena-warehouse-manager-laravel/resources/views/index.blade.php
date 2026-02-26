@extends('layouts.app')

@section('title', 'Almacén')

@section('big-content-desc')
    <h2 class="text-center">Ambientes en uso</h2>
    <br>
    @include('layouts.messages')
    @foreach($dataClassroom->chunk(3) as $chunk)
        <div class="row">
            @foreach($chunk as $clr)
                <div class="col-md-4">
                    @if($clr->disponibilidad == 'no disponible')
                        <div>
                            <div id="{{ $clr->id }}" class="classroom-card card clr-entregar" data-toggle="modal" data-target="#modal_entregar_ambiente" data-id-ambiente="{{ $clr->id }}" data-prestamo="{{ $clr->prestado_en }}" data-id-instructor="{{ $clr->instructor->id }}" data-id-classgroup="{{ $clr->class_group_id }}" >
                                <div class="clr-img">
                                    <img src="{{ asset($clr->imagen) }}" alt="" class="{{ $clr->imagen == '/images/sin_foto.png' ? 'center-block sin-foto' : ''}} img-classroom img-responsive">
                                </div>
                                <div class="clr-desc">
                                    <div class="desc-1">
                                        <h5 class="" data-nombre-ambiente="{{ $clr->nombre_ambiente }}">{{ $clr->nombre_ambiente }}</h5>
                                        <div class="clearfix"><span class="pull-right"></span></div>
                                    </div>
                                    <hr>
                                    <div class="desc-1 desc-prestamo">
                                        <div class="text-capitalize">{{ $clr->instructor->nombre.' '.$clr->instructor->apellidos }}</div>
                                        <div class="clr-classgroup">{{ $clr->classgroup->nombre_ficha }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach
@endsection


@section('content')
    {{-- <hr>
    <div class="buscar-ambiente">
        <h1 class="text-center">Buscar ambientes disponibles por nombre</h1>
        <input type="search" id="wnombre_ambiente" class="form-control search-navbar" placeholder="Buscar ambiente" autocomplete="off" autofocus>
        <button type="button" id="btn-buscar-ambiente">
            <i class="fa fa-fw fa-search"></i>
        </button>
    </div>
    <div id="classroom-resultados">
        <h3></h3>
        <div class="resultados">

        </div>
    </div> --}}

    <div id="classroom-section">
        <h2 class="text-center">Todos los ambientes CPIC</h2>
        <br>
        @foreach($dataClassroom->chunk(3) as $chunk)
            <div class="row">
                @foreach($chunk as $clr)
                    <div class="col-md-4">
                        @if($clr->estado == 'inactivo')
                            <div>
                                <div class="classroom-card card clr-inactive">
                                    <div class="clr-img">
                                        <img src="{{ asset($clr->imagen) }}" alt="" class="{{ $clr->imagen == '/images/sin_foto.png' ? 'center-block sin-foto' : ''}} img-classroom img-clrinactive img-responsive">
                                    </div>
                                    <div class="clr-desc">
                                        <div class="desc-1">
                                            <h5 class="" data-nombreClr="{{ $clr->nombre_ambiente }}">{{ $clr->nombre_ambiente }}</h5>
                                        </div>
                                        <hr>
                                        <div class="desc-1">
                                            <p>El ambiente está inactivo.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($clr->estado == 'en reparacion')
                            <div>
                                <div class="classroom-card card clr-repair">
                                    <div class="clr-img">
                                        <img src="{{ asset($clr->imagen) }}" alt="" class="{{ $clr->imagen == '/images/sin_foto.png' ? 'center-block sin-foto' : ''}} img-classroom img-clrinactive img-responsive">
                                    </div>
                                    <div class="clr-desc">
                                        <div class="desc-1">
                                            <h5 class="">{{ $clr->nombre_ambiente }}</h5>
                                        </div>
                                        <span class="circle"><i class="fa fa-fw fa-minus"></i></span>
                                        <hr class="hr-repair">
                                        <div class="desc-1">
                                            <p>El ambiente se encuentra en reparación</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($clr->disponibilidad == 'disponible')
                            <div>
                                <div class="classroom-card card amb-disponible" data-id-ambiente="{{ $clr->id }}" data-toggle="modal" data-target="#modal_solicitar_prestamo" id="ffd">
                                    <div class="clr-img">
                                        <img src="{{ asset($clr->imagen) }}" alt="" class="{{ $clr->imagen == '/images/sin_foto.png' ? 'center-block sin-foto' : ''}} img-classroom img-responsive">
                                    </div>
                                    <div class="clr-desc">
                                        <div class="desc-1">
                                            <h5 class="" data-nombre-ambiente="{{ $clr->nombre_ambiente }}">{{ $clr->nombre_ambiente }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection

@section('right-content')
    @if(Auth::guest())
        <h4>Últimos prestamos</h4>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-small">
                    <thead>
                        <tr>
                            <th>Instructor</th>
                            <th>Ambiente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataHistoryR as $his)
                            <tr class="text-capitalize">
                                <td>{{ $his->instructor->nombre }}</td>
                                <td>{{ $his->classroom->nombre_ambiente }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if ($errors->has('token_error'))
    <!-- Modal -->
    <div class="modal fade" id="modalSession" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Sesión expirada</h4>
                </div>
                <div class="modal-body">
                    {{ $errors->first('token_error') }}
                </div>
                <div class="modal-footer">
                    <a href="{{ url('/') }}" class="btn-link">Volver a la página principal</a>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="modal_solicitar_prestamo">
        <div class="modal-dialog modal-prestamo" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-capitalize"></h4>
                </div>
                <div class="modal-body modal-prestar">
                    <!-- Input de búsqueda de instructor -->
                    <div class="">
                        <p class="h4">Por favor introduzca el número de documento del instructor.</p>
                        <!-- <i class="fa fa-fw fa-barcode"></i> -->
                        <input type="search" id="buscar_instructor" class="form-control" placeholder="Documento Instructor" autocomplete="off" autofocus>
                        <button class="" id="btn_instructor" type="button">
                            <i class="fa fa-fw fa-search"></i>
                        </button>
                    </div>

                    <br>
                    <!-- Formulario para préstamo -->
                    <form action="" method="POST" id="form-prestamo">
                        @csrf
                        <div class="clearfix">
                            <input name="id" type="hidden" value="" id="id_ambiente">
                            <input name="prestado_en" type="hidden" value="">
                        </div>
                        <div class="row d-flex">
                            <div class="col-md-6">
                                Instructor:
                                <div id="resultado_instructor"></div>
                            </div>
                            <div class="col-md-6" style="border-left: 1px solid #eee">
                                <div>
                                    <p>Una vez identificado el instructor selecciona el grupo</p>
                                    <select name="class_group_id" class="select">
                                        <option value="">Seleccione una ficha...</option>
                                        @foreach($dataFicha as $ficha)
                                            <option value="{{ $ficha->id }}">{{ $ficha->id_ficha.' '.$ficha->nombre_ficha }}</option>
                                        @endforeach
                                    </select>
                                    <span id="mensaje" class="help-block" style="color:#a94442"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn-prestar-ambiente">Prestar Ambiente</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_entregar_ambiente">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-capitalize" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="form-entrega">
                        @csrf
                        <input name="prestado_en" type="hidden" value="" id="prestado_en">

                        <input name="id" type="hidden" value="" id="id-clrEntrega">
                        <input type="hidden" value="" name="instructor_id">
                        <input type="hidden" value="" name="class_group_id">
                        <div class="form-group">
                            <label class="label-control">Agregar novedad</label>
                            <textarea name="novedad" rows="4" cols="80" class="form-control" autofocus></textarea>
                            {{-- <input name="novedad" value="sin novedad" type="hidden"> --}}

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary modify_historical" id="btn-entregar-ambiente">Entregar Ambiente</button>
                </div>
            </div>
        </div>
    </div>
@endsection
