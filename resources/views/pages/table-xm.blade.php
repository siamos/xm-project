@extends('layouts.default')
@section('content')
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>

    <table class="table table-sm">
        <thead>
        <tr>
            <th>Date</th>
            <th>Open</th>
            <th>High</th>
            <th>Low</th>
            <th>Close</th>
            <th>Volume</th>
        </tr>
        </thead>
        <tbody>
        @if (!empty($data))
            @foreach($data as $value)
                <tr>
                    <td>{{ date('Y-m-d', $value->date) }}</td>
                    <td>{{ $value->open }}</td>
                    <td>{{ $value->high }}</td>
                    <td>{{ $value->low }}</td>
                    <td>{{ $value->close }}</td>
                    <td>{{ $value->volume }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop

@section('footer')
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Ericsson Stock Price"
                },
                subtitles: [{
                    text: "Currency in US Dollar"
                }],
                axisX: {
                    interval: 1,
                    valueFormatString: "MMM-YY",
                    labelAngle: -45
                },
                axisY: {
                    suffix: " us"
                },
                data: [{
                    type: "candlestick",
                    xValueType: "dateTime",
                    yValueFormatString: "#,##0.00000 us",
                    xValueFormatString: "MMM-YY",
                    dataPoints: {!! $chartPoints !!}
                }]
            });
            chart.render();
        }
    </script>
@stop
