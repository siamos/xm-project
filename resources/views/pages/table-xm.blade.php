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
                    <td>{{ $value->open ?? null }}</td>
                    <td>{{ $value->high ?? null }}</td>
                    <td>{{ $value->low ?? null }}</td>
                    <td>{{ $value->close ?? null }}</td>
                    <td>{{ $value->volume ?? null }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop

@section('footer')
    <script>
        window.onload = function() {
            var title = "{{ $company['Company Name'] }}";
            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: title
                },
                subtitles: [{
                    text: "Currency in US Dollar"
                }],
                axisX: {
                    interval: 7,
                    intervalType: "day",
                    valueFormatString: "YY-MM-DD",
                    labelAngle: -45
                },
                axisY: {
                    suffix: " us"
                },
                data: [{
                    type: "candlestick",
                    xValueType: "dateTime",
                    yValueFormatString: "#,##0.00000 us",
                    xValueFormatString: "YY-MM-DD",
                    dataPoints: {!! $chartPoints !!}
                }]
            });
            chart.render();
        }
    </script>
@stop
