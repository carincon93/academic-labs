@extends('layouts.app')

@section('title', 'Ver ambiente')

@section('big-content-desc')
	<ul class="breadcrumb">
		<li><a href="{{ url('/admin/classroom') }}" class="btn-link">Lista de ambientes</a></li>
		<li>Ver ambiente</li>
	</ul>
@endsection

@section('content')
	<h1 class="text-uppercase">{{ $classroom->nombre_ambiente }}</h1>
	<hr>
	@if (session('status'))
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
			{!!  html_entity_decode(session('status')) !!}
		</div>
	@endif
	<div class="table-responsive">
		<table class="table table-stripped table-bordered table-hover">
			<tr>
				<th>id</th>
				<td>{{ $classroom->id }}</td>
			</tr>
			<tr>
				<th>Nombre de ambiente</th>
				<td>{{ $classroom->nombre_ambiente }}</td>
			</tr>
			<tr>
				<th>Tipo de ambiente</th>
				<td>{{ $classroom->tipo_ambiente }}</td>
			</tr>
			<tr>
				<th>Movilidad</th>
				<td>{{ $classroom->movilidad }}</td>
			</tr>
			<tr>
				<th>Cupo</th>
				<td>{{ $classroom->cupo }}</td>
			</tr>
			<tr>
				<th>Foto de ambiente</th>
				<td><img src="{{ asset($classroom->imagen) }}" width="200px" class="img-responsive"></td>
			</tr>
		</table>
	</div>
@endsection
