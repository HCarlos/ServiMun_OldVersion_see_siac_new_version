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
                            <i class="mdi mdi-square-outline " style="background: {{ strtoupper(trim($d->class_css)) }} !important;"></i> {{ $d->dependencia}}
                            <span class="float-right">{{ $d->total }}</span>
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
                                    <td scope="row">{{ $d->dependencia_id }}</td>
                                    <td>{{ $d->abreviatura }}</td>
                                    <td>{{ $d->ocho ?? '' }}</td>
                                    <td>{{ $d->dos ?? ''  }}</td>
                                    <td>{{ $d->uno ?? ''  }}</td>
                                    <td>{{ $d->tres ?? ''  }}</td>
                                    <td>{{ $d->cuatro ?? ''  }}</td>
                                    <td>{{ $d->siete ?? ''  }}</td>
                                    <td>{{ $d->nueve ?? ''  }}</td>
                                    <td>{{ $d->once ?? ''  }}</td>
                                    <td>{{ $d->diez ?? ''  }}</td>
                                    <td>{{ $d->cinco ?? ''  }}</td>
                                    <td>{{ $d->seis ?? ''  }}</td>
                                    <td>{{ $d->doce ?? ''  }}</td>
                                    <td>{{ intval($d->ocho) + intval($d->dos) + intval($d->uno) + intval($d->tres) + intval($d->cuatro) + intval($d->siete) + intval($d->nueve) + intval($d->once) + intval($d->diez) + intval($d->cinco) + intval($d->seis) + intval($d->doce)  ?? ''  }}</td>
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
                      ['{{$d->abreviatura}}', {{ $d->total }}, 'color: {{ strtoupper(trim($d->class_css)) }}'],
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
                     '{{ strtoupper(trim($d->class_css))  }}',
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
                '{{ $d->abreviatura }}',
                parseInt({{ intval( $d->ocho ) ?? 0}},0),
                parseInt({{ intval( $d->dos ) ?? 0 }},0),
                parseInt({{ intval( $d->uno ) ?? 0 }},0),
                parseInt({{ intval( $d->tres ) ?? 0 }},0),
                parseInt({{ intval( $d->cuatro ) ?? 0 }},0),
                parseInt({{ intval( $d->siete ) ?? 0 }},0),
                parseInt({{ intval( $d->nueve ) ?? 0 }},0),
                parseInt({{ intval( $d->once ) ?? 0 }},0),
                parseInt({{ intval( $d->diez ) ?? 0 }},0),
                parseInt({{ intval( $d->cinco ) ?? 0 }},0),
                parseInt({{ intval( $d->seis ) ?? 0 }},0),
                parseInt({{ intval( $d->doce ) ?? 0 }},0),
                    '{{$d->ocho + $d->dos + $d->uno + $d->tres + $d->cuatro + $d->siete + $d->nueve + $d->once + $d->diez + $d->cinco + $d->seis + $d->doce}}'
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
