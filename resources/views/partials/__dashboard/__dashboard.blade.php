<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-6">
            <div class="card " style="width: 100% !important;">
                <div class="card-header">
                    <h4 class="header-title">Parámetros de Consulta</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard') }}">
                        @csrf
                        <div class="form-row mb-1">
                            <label for="desde" class="col-md-2 col-form-label text-right">Desde</label>
                            <div class="col-md-4">
                                {{ Form::date('desde', $FI, ['id'=>'desde','class'=>'form-control']) }}
                            </div>
                            <label for="hasta" class="col-md-2 col-form-label text-right">Hasta</label>
                            <div class="col-md-4">
                                {{ Form::date('hasta', $FF, ['id'=>'hasta','class'=>'form-control']) }}
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4  text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-lg-6">
        </div> <!-- end col-->
    </div>
</div>

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-6">
            <div class="card " style="width: 100% !important;">
                <div class="card-header">
                    <h4 class="header-title">Total de Solicitudes</h4>
                </div>
                <div class="card-body">
                    <div class="chart-widget-list">
                        @foreach($totales as $d)
                        <p>
                            <i class="mdi mdi-square-outline " style="background: {{ strtoupper(trim( $d[ 3 ])) }} !important;"></i> {{ $d[ 1 ] }}
                            <span class="float-right"></span> {{ $d[ 16 ] }}
                        </p>
                        @endforeach
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-lg-6" style="width: 100% !important;">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5 mt-4" id="bar1" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-12" style="width: 100% !important;">
            <div class="card " style="width: 100% !important;">
                <div class="card-header">
                    <h4 class="header-title">Relación de Dependencia y Estatus</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Abreviatura</th>
                                <th scope="col">Rec</th>
                                <th scope="col">Ges</th>
                                <th scope="col">EnP</th>
                                <th scope="col">NoP</th>
                                <th scope="col">Tur</th>
                                <th scope="col">Ord</th>
                                <th scope="col">Ana</th>
                                <th scope="col">Est</th>
                                <th scope="col">Amp</th>
                                <th scope="col">Sup</th>
                                <th scope="col">Res</th>
                                <th scope="col">Cer</th>
                                <th scope="col">Total</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($totalestatus as $d)
                                <tr>
                                    <td scope="row">{{ $d[ 0 ] }}</td>
                                    <td scope="row">{{ $d[ 2 ] }}</td>
                                    <td scope="row">{{ $d[ 4 ] }}</td>
                                    <td scope="row">{{ $d[ 5 ] }}</td>
                                    <td scope="row">{{ $d[ 6 ] }}</td>
                                    <td scope="row">{{ $d[ 7 ] }}</td>
                                    <td scope="row">{{ $d[ 8 ] }}</td>
                                    <td scope="row">{{ $d[ 9 ] }}</td>
                                    <td scope="row">{{ $d[ 10 ] }}</td>
                                    <td scope="row">{{ $d[ 11 ] }}</td>
                                    <td scope="row">{{ $d[ 12 ] }}</td>
                                    <td scope="row">{{ $d[ 13 ] }}</td>
                                    <td scope="row">{{ $d[ 14 ] }}</td>
                                    <td scope="row">{{ $d[ 15 ] }}</td>
                                    <td scope="row">{{ $d[ 16 ] }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div  id="chart_div" style="width: 100% !important; height: 1600px;"></div>
                </div>
        </div>
    </div>
</div>



@section('script_interno')
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" >




    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.load('visualization', '1', {packages: ['corechart', 'bar']});
    google.setOnLoadCallback(drawChart);
    google.setOnLoadCallback(drawChartMatrix);

        // google.charts.setOnLoadCallback(drawBasic);

    //google.charts.setOnLoadCallback(drawChart);

//    google.charts.setOnLoadCallback(drawChartMatrix);

    // google.charts.setOnLoadCallback(Stacked);


    function drawChart() {


        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Dependencia');
        data.addColumn('number', 'Total');
        data.addColumn({type: 'string', role: 'style'});
        data.addRows([
                @foreach($totales as $d)
                      ['{{ $d[ 2 ] }}', {{ $d[ 16 ] }}, 'color: {{ strtoupper(trim( $d[ 3 ] )) }}'],
                @endforeach
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" },
            2]);

        var options = {
            chart: {
                title: 'Gráfica de Captura de Solicitudes',
                subtitle: 'Corte al : @php echo date('d-m-Y H:i:s') @endphp',
            },
            colors: [
                @foreach($totales as $d)
                     '{{ strtoupper(trim(  $d[ 3 ]  ))  }}',
                @endforeach
            ],
            is3D:true,
            'allowHtml' : true,
            bars: 'horizontal'
        };

        var chart = new google.charts.Bar(document.getElementById('bar1'));
        chart.draw(data, options);

    }

    function drawChartMatrix() {

        var data = new google.visualization.arrayToDataTable([
                ['Estatus','Rec','Ges','EnP','NoP','Tur','Ord','Ana','Est','Amp','Sup','Res','Cer',{ role: 'annotation' }],
            @foreach($totalestatus as $d)
                [
                '{{  $d[2 ]  }}',
                parseInt( {{ intval( $d[4] ) ?? 0 }},0),
                parseInt({{ intval( $d[ 5 ] ) ?? 0 }},0),
                parseInt({{ intval( $d[ 6 ] ) ?? 0 }},0),
                parseInt({{ intval( $d[ 7 ] ) ?? 0 }},0),
                parseInt({{ intval( $d[ 8 ] ) ?? 0 }},0),
                parseInt({{ intval( $d[ 9 ] ) ?? 0 }},0),
                parseInt({{ intval( $d[ 10 ] ) ?? 0 }},0),
                parseInt({{ intval( $d[ 11 ] ) ?? 0 }},0),
                parseInt({{ intval( $d[ 12 ] ) ?? 0 }},0),
                parseInt({{ intval( $d[ 13 ] ) ?? 0 }},0),
                parseInt({{ intval( $d[ 14 ] ) ?? 0 }},0),
                parseInt({{ intval( $d[ 15 ] ) ?? 0 }},0),
                    '{{ intval( $d[ 16 ] ) ?? 0 }}'
            ],
        @endforeach

        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" },
            2]);


        var options = {
            title: 'Gráfico de Estatus por Dependencia',
            subtitle: 'Chess opening moves',

            hwidth: 1400,
            height: 1600,
            isStacked: true,
            axes: {
                x: {
                    0: { side: 'top', label: 'Percentage'} // Top x-axis.
                }
            },
            bar: { groupWidth: "90%" }

        };

        //alert(options);

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
        // alert(chart);

    }

    </script>

@endsection()
