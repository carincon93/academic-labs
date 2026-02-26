<table>
	<thead>
		<tr>
			<th>Ficha</th>
			<th>Instructor</th>
			<th>Ambiente</th>
			<th>Fecha prestado</th>
			<th>Fecha entregado</th>
			<th>Novedad</th>
			<th>Novedad nueva</th>
		</tr>
	</thead>
	<tbody>
		@foreach($his as $h)
		<tr>
			<td>
				ID: {{ $h->classgroup->id_ficha }}
				<div class="">
					{{ $h->classgroup->nombre_ficha }}
				</div>
			</td>
			<td>{{ $h->instructor->nombre.' '.$h->instructor->apellidos }}</td>
			<td>{{ $h->classroom->nombre_ambiente}}</td>
			<td>{{ $h->prestado_en }}</td>
			<td>{{ $h->entregado_en != '' ? $h->entregado_en : 'No ha sido entregado aún'}}</td>
			<td>{{ $h->novedad != '' ? $h->novedad : 'Sin novedad'}}</td>
			<td>{{ $h->novedad_nueva != '' ? $h->novedad_nueva : ''}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
