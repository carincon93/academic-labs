@extends('layouts.app')

@section('title','Editar ambiente')

@section('big-content-desc')
	<ul class="breadcrumb">
		<li><a href="{{ url('/admin/classroom') }}" class="btn-link">Lista de ambientes</a></li>
		<li>Editar ambiente</li>
	</ul>
@endsection

@section('content')
	<div class="col-md-8">
		<div class="card-form">
			<form action="{{ url('/admin/classroom/'.$clr->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				{{ method_field('put') }}
				<div class="form-group{{ $errors->has('nombre_ambiente') ? ' has-error' : '' }}">
					<label for="nombre_ambiente" class="control-label">
						Nombre del ambiente *
					</label>
					<input type="text" name="nombre_ambiente" class="form-control" value="{{ $clr->nombre_ambiente }}">
					@if ($errors->has('nombre_ambiente'))
						<span class="help-block">
							{{ $errors->first('nombre_ambiente') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('tipo_ambiente') ? ' has-error' : '' }}">
					<label for="tipo_ambiente" class="control-label">
						Tipo de ambiente *
					</label>
					<select name="tipo_ambiente" class="form-control">
						<option value="auditorio" {{ $clr->tipo_ambiente == 'auditorio' ? 'selected="selected"' : '' }}>Auditorio</option>
						<option value="aula" {{ $clr->tipo_ambiente == 'aula' ? 'selected="selected"' : '' }}>Aula</option>
						<option value="campo deportivo" {{ $clr->tipo_ambiente == 'campo deportivo' ? 'selected="selected"' : '' }}>Campo deportivo</option>
						<option value="laboratorio" {{ $clr->tipo_ambiente == 'laboratorio' ? 'selected="selected"' : '' }}>Laboratorio</option>
						<option value="taller" {{ $clr->tipo_ambiente == 'taller' ? 'selected="selected"' : ''  }}>Taller</option>
					</select>
					@if ($errors->has('tipo_ambiente'))
						<span class="help-block">
							{{ $errors->first('tipo_ambiente') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('movilidad') ? ' has-error' : '' }}">
					<label for="movilidad" class="control-label">
						Movilidad *
					</label>
					<select name="movilidad" class="form-control">
						<option value="fijo" {{ $clr->movilidad == 'fijo' ? 'selected="selected"' : '' }}>Fijo</option>
						<option value="movil" {{ $clr->movilidad == 'movil' ? 'selected="selected"' : '' }}>Móvil</option>
					</select>
					@if ($errors->has('movilidad'))
						<span class="help-block">
							{{ $errors->first('movilidad') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
					<label for="estado" class="control-label">
						Estado *
					</label>
					<select name="estado" class="form-control">
						<option value="activo" {{ $clr->estado == 'activo' ? 'selected="selected"' : '' }}>Activo</option>
						<option value="inactivo" {{ $clr->estado == 'inactivo' ? 'selected="selected"' : '' }}>Inactivo</option>
						<option value="en reparacion" {{ $clr->estado == 'en reparacion' ? 'selected="selected"' : '' }}>En reparación</option>
					</select>
					@if ($errors->has('estado'))
						<span class="help-block">
							{{ $errors->first('estado') }}
						</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('cupo') ? ' has-error' : '' }}">
					<label for="cupo" class="control-label">
						Cupo *
					</label>
					<input type="number" name="cupo" min="0" class="form-control" value="{{ $clr->cupo }}">
					@if ($errors->has('cupo'))
						<span class="help-block">
							{{ $errors->first('cupo') }}
						</span>
					@endif
				</div>
				<div class="form-group">
					<label for="imagen">
						Foto del ambiente
					</label>
					<input type="file" name="imagen" class="form-control">
				</div>
				<button class="btn btn-success" type="submit">
					<i class="fa fa-fw fa-paper-plane"></i>
					Modificar
				</button>
			</form>

		</div>
	</div>

	<div class="col-md-4">
		<h3><i class="fa fa-fw fa-pencil"></i> Editar Ambiente</h3>
		<p>
			Diligencie este formulario para editar el ambiente.
		</p>
		<blockquote class="note note-info {{ count($errors) > 0 ? 'note-danger animated shake' : '' }}">
			Los campos que tienen asterisco <span class="btn">*</span> son obligatorios. <br>
			{{ count($errors) > 0 ? 'Por favor echa un vistazo a los errores y asegurate de llenar bien cada campo.' : '' }}
		</blockquote>
	</div>


@endsection
