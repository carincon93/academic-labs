@extends('layouts.app')

@section('title','Adicionar ficha')

@section('big-content-desc')
	<ul class="breadcrumb">
		<li><a href="{{ url('/admin/class_group') }}" class="btn-link">Lista de fichas</a></li>
		<li>Adicionar ficha</li>
	</ul>
@endsection

@section('big-content-desc')
	<h4>Adicionar ficha</h4>
@endsection

@section('content')
	<div class="col-md-8">
		<div class="card-form">
			<form action="{{ url('/admin/class_group') }}" method="POST" data-toggle="validator" role="form">
				@csrf
				<div class="form-group{{ $errors->has('id_ficha') ? ' has-error' : '' }}">
					<label for="id_ficha" class="control-label">
						ID de ficha *
					</label>
					<input type="number" name="id_ficha" class="form-control" min="0" value="{{ old('id_ficha') }}">
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
					<input type="text" name="nombre_ficha" class="form-control" value="{{ old('nombre_ficha') }}">
					@if ($errors->has('nombre_ficha'))
						<span class="help-block">
							{{ $errors->first('nombre_ficha') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('numero_documento') ? ' has-error' : '' }}">
					<label for="numero_documento" class="control-label">
						Instructor *
					</label>
					<select name="instructor_id" class="form-control select">
						<option value="">Seleccione un instructor...</option>
						@foreach($dataInstructor as $ins)
							<option value="{{ $ins->id }}" {{ (old("id") == $ins->numero_documento ? "selected" : "")}}>{{ $ins->nombre.' '.$ins->apellidos }}</option>
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
						<option value="">Seleccione el tipo de formación..</option>
						<option value="presencial" {{ (old("tipo_formacion") == 'presencial' ? "selected" : "")}}>Presencial</option>
						<option value="virtual" {{ (old("tipo_formacion") == 'virtual' ? "selected" : "")}}>Virtual</option>
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
		<h3><i class="fa fa-fw fa-plus"></i> Adicionar Ficha</h3>
		<p>
			Diligencie este formulario para agregar una nueva ficha.
		</p>
		<blockquote class="note note-info {{ count($errors) > 0 ? 'note-danger animated shake' : '' }}">
			Los campos que tienen asterisco <span class="btn">*</span> son obligatorios. <br>
			{{ count($errors) > 0 ? 'Por favor echa un vistazo a los errores y asegurate de llenar bien cada campo.' : '' }}
		</blockquote>
	</div>
@endsection
