@extends('layouts.app')

@section('title', 'Attendance')

@section('content')
    <div class="row">
    	<div class="col-md-4"></div>
    	<div class="col-md-4">
            <br><br>
            <div class="card">
                <div class="card-body">
                <center>
                    {{ Html::image('images/attend.png', 'Login', ['width' => '200px', 'id' => 'loginlogo']) }}
                    <h3 style="margin:20px 0;">ATTENDANCE!</h3>
                </center>
                {!! Form::open(['action' => 'AttendanceController@store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('stud_id', 'Student #')}}
                        {{Form::text('stud_id', '', ['class' => 'form-control', 'placeholder' => 'xx-xx-xxxx-xxx', 'maxlength' => '14', 'id' => 'studid', 'required', 'autocomplete' => 'off'])}}
                    </div>
                    <br>
                    {{Form::submit('Time In', ['class' => 'btn btn-outline-light btn-block', 'value' => 'time_in', 'name' => 'time_in', 'id' => 'submitbtn'])}}
                    {{Form::submit('Time Out', ['class' => 'btn btn-outline-light btn-block', 'value' => 'time_out', 'name' => 'time_out', 'id' => 'submitbtn'])}}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    	<div class="col-md-4"></div>
    </div>
    
@endsection

@section('jquery')
    $('#studid').keydown(function (e) {
       var key = e.charCode || e.keyCode || 0;
       $text = $(this); 
       if (key !== 8 && key !== 9) {
           if ($text.val().length === 2) {
               $text.val($text.val() + '-');
           }
           if ($text.val().length === 5) {
               $text.val($text.val() + '-');
           }
           if ($text.val().length === 10) {
               $text.val($text.val() + '-');
           }

       }

       return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
   })
@endsection