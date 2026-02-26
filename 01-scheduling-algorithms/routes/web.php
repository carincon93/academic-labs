<?php

use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\QuantumController;
use App\Models\Proceso;
use App\Models\Quantum;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('proceso')->with('quantum', Quantum::find(1))->with('procesos', Proceso::orderBy('id')->get());
});

// ALGORITMO FCFS
Route::get('/fcfs', function () {
    // Obtiene todos los procesos en orden de llegada
    $procesos = Proceso::orderBy('id')->get();

    // Variables inicialidas -> Para calcular el Tiempo de espra y retorno
    $tiempoEspera = collect([]);
    $tiempoRetorno = collect([]);
    $duracionTE = 0;
    $duracionTR = 0;

    // Recorre cada proceso y extrae la duración de la BD
    foreach ($procesos as $key => $proceso) {
        // Si es el primer proceso se añade un nuevo proceso con tiempo de duración = 0 (Debido a que el primero proceso siempre empieza en 0)
        if ($key == 0) {
            $tiempoEspera->push([
                'duracion' => $duracionTE,
            ]);
        }

        // Si no es el primer proceso se añade la suma de la duración del proceso anterior con la actual
        $tiempoEspera->push([
            'duracion' => $duracionTE += $proceso->duracion,
        ]);

        // Si no es el primer proceso se añade la suma de la duración del proceso anterior con la actual
        $tiempoRetorno->push([
            'duracion' => $duracionTR += $proceso->duracion,
        ]);
    }

    // Se calcula el promedio del TR (Total de duración dividido la cantidad de procesos)
    $promedioRetorno = $tiempoRetorno->sum('duracion') / count($tiempoRetorno);

    // Como en primer lugar se añade 'manualmente' un proceso con tiempo de duración 0 se debe eliminar el último proceso para que quede la misma cantidad de la BD
    $tiempoEspera = $tiempoEspera->slice(0, -1);

    // Se calcula el promedio de TE (Total de duración dividido la cantidad de procesos)
    $promedioEspera = $tiempoEspera->sum('duracion') / count($tiempoEspera);

    return view('fcfs')->with('procesos', $procesos)->with('promedioEspera', $promedioEspera)->with('promedioRetorno', $promedioRetorno);
});

// ALGORITMO SJF
Route::get('/sjf', function () {
    // Obtiene todos los procesos en orden de duración - De menor a mayor
    $procesos = Proceso::orderBy('duracion', 'ASC')->get();

    // Variables inicialidas -> Para calcular el Tiempo de espra y retorno
    $tiempoEspera = collect([]);
    $tiempoRetorno = collect([]);
    $duracionTE = 0;
    $duracionTR = 0;

    // Recorre cada proceso y extrae la duración de la BD
    foreach ($procesos as $key => $proceso) {
        // Si es el primer proceso se añade un nuevo proceso con tiempo de duración = 0 (Debido a que el primero proceso siempre empieza en 0)
        if ($key == 0) {
            $tiempoEspera->push([
                'duracion' => $duracionTE,
            ]);
        }

        // Si no es el primer proceso se añade la suma de la duración del proceso anterior con la actual
        $tiempoEspera->push([
            'duracion' => $duracionTE += $proceso->duracion,
        ]);

        $tiempoRetorno->push([
            'duracion' => $duracionTR += $proceso->duracion,
        ]);
    }

    // Se calcula el promedio del TR (Total de duración dividido la cantidad de procesos)
    $promedioRetorno = $tiempoRetorno->sum('duracion') / count($tiempoRetorno);

    // Como en primer lugar se añade 'manualmente' un proceso con tiempo de duración 0 se debe eliminar el último proceso para que quede la misma cantidad de la BD
    $tiempoEspera = $tiempoEspera->slice(0, -1);

    // Se calcula el promedio de TE (Total de duración dividido la cantidad de procesos)
    $promedioEspera = $tiempoEspera->sum('duracion') / count($tiempoEspera);

    return view('sjf')->with('procesos', $procesos)->with('promedioEspera', $promedioEspera)->with('promedioRetorno', $promedioRetorno);
});

// ALGORITMO Prioridad
Route::get('/prioridad', function () {
    // Obtiene todos los procesos en orden de prioridad - De mayor a menor
    $procesos = Proceso::orderBy('prioridad', 'ASC')->get();

    // Variables inicialidas -> Para calcular el Tiempo de espra y retorno
    $tiempoEspera = collect([]);
    $tiempoRetorno = collect([]);
    $duracionTE = 0;
    $duracionTR = 0;

    // Recorre cada proceso y extrae la duración de la BD
    foreach ($procesos as $key => $proceso) {
        // Si es el primer proceso se añade un nuevo proceso con tiempo de duración = 0
        if ($key == 0) {
            $tiempoEspera->push([
                'duracion' => $duracionTE,
            ]);
        }

        // Si no es el primer proceso se añade la suma de la duración del proceso anterior con la actual
        $tiempoEspera->push([
            'duracion' => $duracionTE += $proceso->duracion,
        ]);

        $tiempoRetorno->push([
            'duracion' => $duracionTR += $proceso->duracion,
        ]);
    }

    // Se calcula el promedio del TR (Total de duración dividido la cantidad de procesos)
    $promedioRetorno = $tiempoRetorno->sum('duracion') / count($tiempoRetorno);

    // Como en primer lugar se añade 'manualmente' un proceso con tiempo de duración 0 se debe eliminar el último proceso para que quede la misma cantidad de la BD
    $tiempoEspera = $tiempoEspera->slice(0, -1);

    // Se calcula el promedio de TE (Total de duración dividido la cantidad de procesos)
    $promedioEspera = $tiempoEspera->sum('duracion') / count($tiempoEspera);

    return view('prioridad')->with('procesos', $procesos)->with('promedioEspera', $promedioEspera)->with('promedioRetorno', $promedioRetorno);
});

// ALGORITMO ROUND ROBIN
Route::get('/rr', function () {
    // Obtiene todos los procesos en orden de llegada
    $procesos = Proceso::orderBy('id')->get();
    // Obitene el quantum
    $quantum  = Quantum::orderBy('id')->first();

    // Variables inicialidas -> Para calcular el Tiempo de espra y retorno
    $procesosFaltantes = [];
    $arregloFinal = collect([]);
    $pos_fin = 0;
    $pos_ini = 0;

    // Recorre cada proceso, los divide según el quantum y nos indica los nuevos procesos faltantes
    foreach ($procesos as $key => $proceso) {
        $restante = $proceso->duracion - $quantum->q;

        // Se calcula el tiempo de llegada de cada proceso
        if ($key == 0) {
            // Si es el primer proceso le asigna el tiempo de llegada = 0
            $pos_ini = 0;
        } else if ($key == 1) {
            // Si es el segundo proceso le asigna el tiempo de llegada = quantum ya definido previamente
            $pos_ini += $quantum->q;
        } else {
            // El resto de procesos se le asigna el tiempo de llegada de acuerdo a: duración_proceso_actual o quantum + duracion_proceso_anterior o quantum
            $pos_ini += $procesos[$key - 1]['duracion'] > $quantum->q ? $quantum->q : $procesos[$key - 1]['duracion'];
        }

        // En el arreglo $procesosFaltantes se añaden los procesos con una nueva columna de procesos faltantes para calcular según el quantum cuantos procesos más se deben añadir
        array_push($procesosFaltantes, [
            'id'                => $proceso->id,
            'nombre'            => $proceso->nombre,
            'duracion'          => $proceso->duracion,
            'procesos_restante' => ceil($restante / $quantum->q) > 0 ? ceil($restante / $quantum->q) : 0,
            'tiempo_espera'     => $pos_ini - $key
        ]);
    }

    // Cuenta cuantos procesos hay en BD
    $totalProcesosfaltantes = count($procesosFaltantes);
    $restante = 0;
    // Recorre los procesos faltantes según el quantum de cada proceso y los añade al arregloFinal
    while ($totalProcesosfaltantes != 0) {
        foreach ($procesosFaltantes as $key => $procesoFaltante) {
            if ($procesoFaltante['procesos_restante'] >= 0) {
                $arregloFinal->push([
                    'id'                => count($arregloFinal) + 1,
                    'nombre'            => $procesoFaltante['nombre'],
                    'duracion'          => $procesoFaltante['duracion'] > $quantum->q ? $quantum->q : (int) $procesoFaltante['duracion'],
                    'pos_fin'           => $pos_fin += $procesoFaltante['duracion'] > $quantum->q ? $quantum->q : (int) $procesoFaltante['duracion'],
                ]);
            }

            // Cada que el algoritmo encuenta que no hay procesos faltantes de un proceso se resta de la variable del total de procesos faltantes
            if ($procesoFaltante['procesos_restante'] == 0) {
                $totalProcesosfaltantes -= 1;
            }

            // Va restando el tiempo de duración del proceso recorrido según el quantum
            $procesosFaltantes[$key]['duracion'] -= $quantum->q;
            $procesosFaltantes[$key]['procesos_restante'] = $procesoFaltante['procesos_restante'] - 1;
        }
    }

    // Se calcula el promedio de TR
    $promedioRetorno = $arregloFinal->sortByDesc('pos_fin')->unique('nombre')->sum('pos_fin') / count($arregloFinal->sortByDesc('pos_fin')->unique('nombre'));

    // Se calcula el promedio de TE
    $promedioEspera = collect($procesosFaltantes)->sum('tiempo_espera') / count($procesosFaltantes);

    return view('rr')->with('procesos', $arregloFinal)->with('promedioEspera', $promedioEspera)->with('promedioRetorno', $promedioRetorno);
});

// Guardar los procesos
Route::post('procesos/store', [ProcesoController::class, 'store'])->name('procesos.store');
// Guardar el quantum
Route::post('quantum/store', [QuantumController::class, 'store'])->name('quantum.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
