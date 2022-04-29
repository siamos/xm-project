@extends('layouts.default')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ Form::open(['route' => 'store']) }}
    <div class="form-container">
        <div class="form-group">
            {{ Form::label('company_symbol', 'Company Symbol') }}
            {{ Form::text('company_symbol', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Email Address') }}
            {{ Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        {{ Form::label('start_date', 'Start Date') }}
        {{ Form::text('start_date', null, ['id' => 'start-date', 'required' => 'required']) }}

        {{ Form::label('end_date', 'End Date') }}
        {{ Form::text('end_date', null, ['id' => 'end-date', 'required' => 'required']) }}

        <div class="form-group">
            {{Form::submit('GET DATA')}}
        </div>
    </div>
    {{ Form::close() }}
@stop
@section('footer')
    <script>
        $(function () {
            $("#start-date").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $("#end-date").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        });
    </script>
@stop
