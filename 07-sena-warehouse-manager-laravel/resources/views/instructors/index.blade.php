@extends('layouts.app')

@section('title', 'Instructores')

@section('big-content-desc')
    <ul class="breadcrumb">
        <li>Lista de instructores</li>
    </ul>
@endsection

@section('content')
    @include('layouts.messages')
    <div class="card">
        <div class="table-responsive card-content">
            <table class="table table-full table-hover" id="myTable" data-form="deleteForm">
                <caption>
                    <a href="{{ url('/admin/instructor/create') }}" class="btn btn-success"><i class="fa fa-fw fa-user-plus"></i> Añadir instructor</a>
                </caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre Instructor</th>
                        <th>Área</th>
                        <th>No Celular</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody  class="history" id="myTableIns">
                    @php
                    $count = 1;
                    @endphp
                    @foreach($dataInstructor as $ins)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $ins->nombre.' '.$ins->apellidos }}</td>
                            <td>{{ $ins->area }}</td>
                            <td>{{ $ins->celular }}</td>
                            <td class="td-actions">
                                <a class="btn btn-round" href="{{ url('/admin/instructor/'.$ins->id) }}" data-toggle="tooltip" data-placement="top" title="Ver instructor">
                                    <i class="fa fa-fw fa-search"></i>
                                </a>
                                <a class="btn btn-round" href="{{ url('/admin/instructor/'.$ins->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar instructor">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>
                                @if($ins->disponibilidad == 'disponible')
                                    <form action="{{ url('/admin/instructor/'.$ins->id) }}" method="POST" class="btn-round btn-delete-tbl btn" data-nombre="{{ $ins->nombre.' '.$ins->apellidos }}" data-toggle="tooltip" data-placement="top" title="Eliminar instructor">
                                        {{ method_field('delete') }}
                                        @csrf
                                        <i class="fa fa-fw fa-trash"></i>
                                    </form>
                                @else
                                    <a href="{{ url('/#').$ins->classroom->id }}" class="btn btn-round btn-not-delete" data-title="El instructor tiene un ambiente a cargo, para poder eliminarlo primero debe hacer la entrega del ambiente. Haga clic en este elemento para direccionarte al préstamo de ambientes" ddata-toggle="tooltip" data-placement="bottom">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
