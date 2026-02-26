@extends('layouts.app')

@section('title','Editar ficha')

@section('big-content-desc')
	<ul class="breadcrumb">
		<li><a href="{{ url('/admin/class_group') }}" class="btn-link">Lista de fichas</a></li>
		<li>Editar ficha</li>
	</ul>
@endsection

@section('big-content-desc')
	<h4>Editar ficha</h4>
@endsection

@section('content')
	<div class="col-md-8">
		<div class="card-form">
			<form action="{{ url('/admin/class_group/'.$dataClassGroup->id) }}" method="POST">
				@csrf
				{{ method_field('PUT') }}
				<div class="form-group{{ $errors->has('id_ficha') ? ' has-error' : '' }}">
					<label for="id_ficha" class="control-label">
						ID de ficha *
					</label>
					<input type="number" name="id_ficha" min="0" class="form-control" value="{{ $dataClassGroup->id_ficha }}">
					@if ($errors->has('id_ficha'))
						<span class="help-block">
							{{ $errors->first('id_ficha') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('nombre_ficha') ? ' has-error' : '' }}">
					<label for="nombre_ficha" class="control-label">
						Nombre de ficha *
					</label>
					<input type="text" name="nombre_ficha" class="form-control" value="{{ $dataClassGroup->nombre_ficha }}">
					@if ($errors->has('nombre_ficha'))
						<span class="help-block">
							{{ $errors->first('nombre_ficha') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('instructor') ? ' has-error' : '' }}">
					<label for="numero_documento" class="control-label">Instructor *</label>
					<select name="instructor_id" class="form-control select">
						<option value="">Seleccione un instructor...</option>
						@foreach($dataInstructor as $ins)
							<option value="{{ $ins->id }}" {{ $ins->id==$dataClassGroup->instructor_id ? 'selected="selected"' : '' }}>{{ $ins->nombre.' '.$ins->apellidos }}</option>
						@endforeach
					</select>
					@if ($errors->has('instructor_id'))
						<span class="help-block">
							{{ $errors->first('instructor_id') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('tipo_formacion') ? ' has-error' : '' }}">
					<label for="tipo_formacion" class="control-label">
						Tipo de formación *
					</label>
					<select name="tipo_formacion" class="form-control">
						<option value="presencial" {{ $dataClassGroup->tipo_formacion == 'presencial' ? 'selected="selected"' : '' }}>Presencial</option>
						<option value="virtual" {{ $dataClassGroup->tipo_formacion == 'virtual' ? 'selected="selected"' : '' }}>Virtual</option>
					</select>
					@if ($errors->has('tipo_formacion'))
						<span class="help-block">
							{{ $errors->first('tipo_formacion') }}
						</span>
					@endif
				</div>
				<div class="form-group">
					<button class="btn btn-success" type="submit">
						<i class="fa fa-fw fa-floppy-o"></i>
						Guardar
					</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-4">
		<h3><i class="fa fa-fw fa-pencil"></i> Editar Ficha</h3>
		<p>
			Diligencie este formulario para editar una ficha.
		</p>
		<blockquote class="note note-info {{ count($errors) > 0 ? 'note-danger animated shake' : '' }}">
			Los campos que tienen asterisco <span class="btn">*</span> son obligatorios. <br>
			{{ count($errors) > 0 ? 'Por favor echa un vistazo a los errores y asegurate de llenar bien cada campo.' : '' }}
		</blockquote>
	</div>
@endsection
