@extends('layouts.app')

@section('title', 'Grupos')

@section('big-content-desc')
    <ul class="breadcrumb">
        <li>Lista de fichas</li>
    </ul>
@endsection

@section('content')

    @include('layouts.messages')

    <div class="card">
        <div class="table-responsive card-content">
            <table class="table table-full table-hover" id="myTable" data-form="deleteForm">
                <caption>
                    <a href="{{ url('/admin/class_group/create') }}" class="btn btn-success"><i class="fa fa-fw fa-plus"></i> Añadir grupo</a>
                </caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID de ficha</th>
                        <th>Nombre ficha</th>
                        <th>Tipo de formación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody  id="myTableFicha">
                    @php
                    $count = 1;
                    @endphp
                    @foreach($dataClassGroup as $dg)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $dg->id_ficha }}</td>
                            <td>{{ $dg->nombre_ficha }}</td>
                            <td>{{ $dg->tipo_formacion }}</td>
                            <td class="td-actions">
                                <a class="btn btn-round" href="{{ url('/admin/class_group/'.$dg->id) }}" data-toggle="tooltip" data-placement="top" title="Ver grupo">
                                    <i class="fa fa-fw fa-search"></i>
                                </a>
                                <a class="btn btn-round" href="{{ url('/admin/class_group/'.$dg->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar grupo">
                                    <i class="fa fa-fw fa-pencil"></i>
                                </a>
                                @if($dg->disponibilidad == 'disponible')
                                    <form action="{{ url('/admin/class_group/'.$dg->id) }}" style="display: inline-block;" data-nombre="{{ $dg->nombre_ficha }}" method="POST" class="btn-delete-tbl btn btn-round" data-toggle="tooltip" data-placement="top" title="Eliminar grupo">
                                        {{ method_field('delete') }}
                                        {{ csrf_field()  }}
                                        <i class="fa fa-fw fa-trash"></i>
                                    </form>
                                @else
                                    @foreach($dg->classrooms as $classroom)
                                        <a href="{{ url('/#').$classroom->id }}" class="btn btn-round btn-not-delete" data-title="La ficha aun esta en uso, para poder eliminarlo primero debe hacer la entrega del ambiente. Haga clic en este elemento para direccionarte al préstamo de ambientes" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </a>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
