<x-guest-layout>
    <div class="grid grid-cols-4 gap-4">
        <div class="rounded-lg border p-4">
            <form action="{{ route('quantum.store') }}" method="POST" class="mt-8">
                {{ csrf_field() }}
                <div class="grid space-y-2">
                    <label for="quantum" class="block text-sm">Quantum</label>
                    <input id="quantum" type="number" name="quantum" value="{{ $quantum ? $quantum->q : 0 }}" class="rounded-full py-1 px-4 bg-transparent text-sm">

                    <button class="bg-gray-500 hover:bg-gary-700 p-2 text-xs text-white rounded-full" type="submit">
                        Guardar
                    </button>
                </div>
            </form>
        </div>

        @foreach ($procesos as $proceso)
        <div class="bg-white shadow-lg rounded-lg p-4">
            <h1 class="font-black">Proceso #{{ $proceso->id }}</h1>
            <form action="{{ route('procesos.store') }}" method="POST" class="grid space-y-4">
                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{ $proceso->id }}">

                <div>
                    <label for="nombre_{{$proceso->id}}" class="block text-sm">Nombre del proceso</label>
                    <input id="nombre_{{$proceso->id}}" type="text" name="nombre" value="{{ $proceso->nombre }}" class="rounded-full py-1 px-4 bg-transparent w-full text-sm mt-1">
                </div>

                <div>
                    <label for="duracion_{{$proceso->id}}" class="block text-sm">Duración</label>
                    <input id="duracion_{{$proceso->id}}" type="number" name="duracion" value="{{ $proceso->duracion }}" class="rounded-full py-1 px-4 bg-transparent w-full text-sm mt-1">
                </div>

                <div>
                    <label for="prioridad_{{$proceso->id}}" class="block text-sm">Prioridad</label>
                    <input id="prioridad_{{$proceso->id}}" type="number" name="prioridad" value="{{ $proceso->prioridad }}" class="rounded-full py-1 px-4 bg-transparent w-full text-sm mt-1">
                </div>

                <button class="bg-gray-500 hover:bg-gary-700 p-2 text-xs text-white rounded-full" type="submit">
                    Guardar
                </button>
            </form>
        </div>
        @endforeach

        <div class="border border-violet-300 rounded-lg p-4">
            <h1 class="font-black">Agregar un nuevo proceso</h1>
            <form action="{{ route('procesos.store') }}" method="POST" class="grid space-y-4">
                {{ csrf_field() }}

                <div>
                    <label for="nombre" class="block text-sm">Nombre del proceso</label>
                    <input id="nombre" type="text" name="nombre" class="rounded-full py-1 px-4 bg-transparent w-full text-sm mt-1">
                </div>

                <div>
                    <label for="duracion" class="block text-sm">Duración</label>
                    <input id="duracion" type="number" name="duracion" class="rounded-full py-1 px-4 bg-transparent w-full text-sm mt-1">
                </div>

                <div>
                    <label for="prioridad" class="block text-sm">Prioridad</label>
                    <input id="prioridad" type="number" name="prioridad" class="rounded-full py-1 px-4 bg-transparent w-full text-sm mt-1">
                </div>

                <button class="bg-gray-500 hover:bg-gary-700 p-2 text-xs text-white rounded-full" type="submit">
                    Guardar
                </button>
            </form>
        </div>

        <div class="border rounded-lg p-4">
            <h1 class="font-black">Seleccione una visualización:</h1>

            <ul class="grid grid-cols-2 gap-2 mt-10">
                <li class="bg-violet-100 hover:bg-violet-200 rounded-full p-1 text-sm text-center">
                    <a href="/sjf" class="hover:underline block !w-full">SJF</a>
                </li>

                <li class="bg-violet-100 hover:bg-violet-200 rounded-full p-1 text-sm text-center">
                    <a href="/fcfs" class="hover:underline block !w-full">FCFS</a>
                </li>

                <li class="bg-violet-100 hover:bg-violet-200 rounded-full p-1 text-sm text-center">
                    <a href="/prioridad" class="hover:underline block !w-full">Prioridad</a>
                </li>

                <li class="bg-violet-100 hover:bg-violet-200 rounded-full p-1 text-sm text-center">
                    <a href="/rr" class="hover:underline block !w-full">Round Robin</a>
                </li>
            </ul>
        </div>
    </div>

</x-guest-layout>