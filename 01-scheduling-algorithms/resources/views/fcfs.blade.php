<x-guest-layout>
    @push('scripts')
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['gantt']
            });
            google.charts.setOnLoadCallback(drawChart);

            function toMilliseconds(minutes) {
                return minutes * 60 * 1000;
            }

            function drawChart() {
                var otherData = new google.visualization.DataTable();
                otherData.addColumn("string", "Task ID");
                otherData.addColumn("string", "Task Name");
                otherData.addColumn("string", "Resource");
                otherData.addColumn("date", "Start");
                otherData.addColumn("date", "End");
                otherData.addColumn("number", "Duration");
                otherData.addColumn("number", "Percent Complete");
                otherData.addColumn("string", "Dependencies");

                @foreach ($procesos as $key => $proceso)
                    @if ($key == 0)
                        otherData.addRows([
                            [
                                '{{ $proceso->id }}',
                                '{{ $proceso->nombre }}',
                                '{{ $proceso->id }}',
                                null,
                                null,
                                toMilliseconds({{ $proceso->duracion }}),
                                100,
                                null,
                            ]
                        ]);
                    @else
                        otherData.addRows([
                            [
                                '{{ $proceso->id }}',
                                '{{ $proceso->nombre }}',
                                '{{ $proceso->id }}',
                                null,
                                null,
                                toMilliseconds({{ $proceso->duracion }}),
                                100,
                                "{{ $procesos[$key - 1]['id'] }}",
                            ]
                        ]);
                    @endif
                @endforeach

                let trackHeight = 120;

                var options = {
                    height: {{ count($procesos) + 2 }} * trackHeight,
                    gantt: {
                        defaultStartDate: new Date(2022, 9, 24),
                    },
                };

                var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

                chart.draw(otherData, options);
            }
        </script>
    @endpush
    <h1 class="font-black m-10 text-center text-4xl">FCFS</h1>

    
<div class="grid grid-cols-2 gap-4">
        <div class="bg-violet-100/80 shadow rounded-lg p-4 opacity-75 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <strong class="mr-2">Tiempo promedio de espera: </strong> {{ $promedioEspera }}s
        </div>
        <div class="bg-violet-100/80 shadow rounded-lg p-4 opacity-75 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <strong class="mx-2">Tiempo promedio de retorno: </strong> {{ $promedioRetorno }}s
        </div>
    </div>
    
    <div id="chart_div"></div>
   
    <div class="flex items-center justify-center my-6">
        <a href="/" class="m-auto underline">Volver atrás</a>
    </div>
</x-guest-layout>
