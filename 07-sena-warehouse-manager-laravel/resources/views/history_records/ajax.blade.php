@foreach($hr as $h)
    <tr>
        <td class="text-capitalize">
            ID: {{ $h->id_ficha }}
            <div class="">
                {{ $h->nombre_ficha }}
            </div>
        </td>
        <td class="text-capitalize">{{ $h->nombre.' '.$h->apellidos }}</td>
        <td class="text-capitalize">{{ $h->nombre_ambiente }}</td>
        <td>{{ $h->prestado_en }}</td>
        <td>{{ $h->entregado_en != '' ? $h->entregado_en : 'No ha sido entregado aún' }}</td>

        <td class="td-actions">
            <button class="btn btn-historial" data-toggle="modal" data-target="#modalHistorial" data-id="{{ $h->id }}" data-nombre="{{ $h->nombre_ambiente }}">
                Ver novedades
            </button>
            <form action="{{ url('/admin/history_record/'.$h->id) }}" data-nombre="{{ $h->id_ficha }}" method="POST" style="display: inline-block;" class="btn btn-round btn-delete-tbl">
                {{ method_field('delete') }}
                @csrf
                <i class="fa fa-fw fa-trash"></i>
            </form>
        </td>
    </tr>
@endforeach
