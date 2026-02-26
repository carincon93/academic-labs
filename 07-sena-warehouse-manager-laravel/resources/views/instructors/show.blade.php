@extends('layouts.app')

@section('title', 'Ver instructor')

@section('big-content-desc')
	<ul class="breadcrumb">
		<li><a href="{{ url('/admin/instructor') }}" class="btn-link">Lista de instructores</a></li>
		<li>Ver instructor</li>
	</ul>
@endsection

@section('content')
	<h1 class="text-uppercase">{{ $dataInstructor->nombre.' '.$dataInstructor->apellidos }}</h1>
	<hr>
	<div class="table-responsive">
		<table class="table table-stripped table-bordered table-hover">
			<tr>
				<th>ID</th>
				<td>{{ $dataInstructor->id }}</td>
			</tr>
			<tr>
				<th>Nombre</th>
				<td class="text-capitalize">{{ $dataInstructor->nombre }}</td>

			</tr>
			<tr>
				<th>Apellidos</th>
				<td class="text-capitalize">{{ $dataInstructor->apellidos }}</td>
			</tr>
			<tr>
				<th>Tipo de contrato</th>
				<td class="text-capitalize">{{ $dataInstructor->vinculacion1 }}</td>
			</tr>
			<tr>
				<th>Area</th>
				<td class="text-capitalize">{{ $dataInstructor->area }}</td>
			</tr>
			<tr>
				<th>Número de documento</th>
				<td>{{ $dataInstructor->numero_documento }}</td>
			</tr>
			<tr>
				<th>IP</th>
				<td>{{ $dataInstructor->ip }}</td>
			</tr>
			<tr>
				<th>Celular</th>
				<td>{{ $dataInstructor->celular }}</td>
			</tr>
			<tr>
				<th>Correo electrónico</th>
				<td>{{ $dataInstructor->email }}</td>
			</tr>
			<tr>
				<th>Fichas asignadas</th>
				<td>
					<ul>
						@foreach($dataInstructor->classgroups as $classgroup)
							<li>{{ $classgroup->nombre_ficha }}</li>
						@endforeach
					</ul>
				</td>
			</tr>
		</table>

	</div>
@endsection
