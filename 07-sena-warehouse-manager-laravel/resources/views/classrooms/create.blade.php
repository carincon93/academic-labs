@extends('layouts.app')

@section('title','Adicionar ambiente')

@section('big-content-desc')
	<ul class="breadcrumb">
		<li><a href="{{ url('/admin/classroom') }}" class="btn-link">Lista de ambientes</a></li>
		<li>Adicionar ambiente</li>
	</ul>
@endsection

@section('big-content-desc')
	<h4>Adicionar ambiente</h4>
@endsection

@section('content')
	<div class="col-md-8">
		<div class="card-form">
			<form action="{{ url('/admin/classroom') }}" method="POST" enctype="multipart/form-data">
				<div class="form-group{{ $errors->has('nombre_ambiente') ? ' has-error' : '' }}">
					@csrf
					<div class="form-group{{ $errors->has('nombre_ambiente') ? ' has-error' : '' }}">
						<label for="nombre_ambiente" class="control-label">
							Nombre del ambiente *
						</label>
						<input type="text" name="nombre_ambiente" class="form-control" value="{{ old('nombre_ambiente') }}">
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
							<option value="">Seleccione el tipo de ambiente..</option>
							<option value="aula" {{ (old("tipo_ambiente") == 'aula' ? "selected" : "")}}>Aula</option>
							<option value="taller" {{ (old("tipo_ambiente") == 'taller' ? "selected" : "")}}>Taller</option>
							<option value="auditorio" {{ (old("tipo_ambiente") == 'auditorio' ? "selected" : "")}}>Auditorio</option>
							<option value="campo deportivo" {{ (old("tipo_ambiente") == 'campo deportivo' ? "selected" : "")}}>Campo deportivo</option>
							<option value="laboratorio" {{ (old("tipo_ambiente") == 'laboratorio' ? "selected" : "")}}>Laboratorio</option>
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
							<option value="">Seleccione el tipo de movilidad del ambiente..</option>
							<option value="fijo" {{ (old("movilidad") == 'fijo' ? "selected" : "")}}>Fijo</option>
							<option value="movil" {{ (old("movilidad") == 'movil' ? "selected" : "")}}>Móvil</option>
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
							<option value="">Seleccione el estado en que se encuentra el ambiente..</option>
							<option value="activo" {{ (old("estado") == 'activo' ? "selected" : "")}}>Activo</option>
							<option value="inactivo" {{ (old("estado") == 'inactivo' ? "selected" : "")}}>Inactivo</option>
							<option value="en reparacion" {{ (old("estado") == 'en reparacion' ? "selected" : "")}}>En reparación</option>
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

						<input type="number" name="cupo"  min="0" class="form-control" value="{{ old('cupo') }}">
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
		<h3><i class="fa fa-fw fa-plus"></i> Adicionar Ambiente</h3>
		<p>
			Diligencie este formulario para agregar un nuevo ambiente.
		</p>
		<blockquote class="note note-info {{ count($errors) > 0 ? 'note-danger animated shake' : '' }}">
			Los campos que tienen asterisco <span class="btn">*</span> son obligatorios. <br>
			{{ count($errors) > 0 ? 'Por favor echa un vistazo a los errores y asegurate de llenar bien cada campo.' : '' }}
		</blockquote>
	</div>
@endsection
