@foreach($history_records as $his)
    <form action="{{ url( 'admin/history_record/' . $his->id . '/novedad_nueva') }}" method="POST" id="formNovedadNueva">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="novedad">Novedad vieja</label>
            <textarea id="novedad" name="novedad" rows="8" cols="80" class="form-control" disabled>{{ $his->novedad }}</textarea>
        </div>
        <div class="form-group">
            <label for="novedad_nueva">Novedad nueva</label>
            <textarea id="novedad_nueva" name="novedad_nueva" rows="8" cols="80" class="form-control">{{ $his->novedad_nueva }}</textarea>
        </div>
        <button type="submit" name="button" class="btn btn-success">Guardar novedad</button>
    </form>
@endforeach
