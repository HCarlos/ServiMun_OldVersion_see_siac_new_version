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
                            <i class="mdi mdi-square {{ $arrCls[rand(0,7)] }}"></i> {{ $d->dependencia}}
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
    </div>
</div>

@section('script_interno')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        {{--var data = google.visualization.arrayToDataTable([--}}
        {{--    ['Dependencia', 'Total', { role: 'style' } ],--}}
        {{--    @foreach($totales as $d)--}}
        {{--          ['{{$d->abreviatura}}', {{ $d->total }}, '{{ strtoupper(trim($d->class_css)) == '' ? '#FFCC00' : strtoupper(trim($d->class_css)) }}'],--}}
        {{--    @endforeach--}}
        {{--]);--}}

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Dependencia');
        data.addColumn('number', 'Total');
        data.addColumn({type: 'string', role: 'style'});
        data.addRows([
                @foreach($totales as $d)
                      ['{{$d->abreviatura}}', {{ $d->total }}, 'color: {{ strtoupper(trim($d->class_css)) }}'],
                @endforeach
        ]);

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
</script>

@endsection()
