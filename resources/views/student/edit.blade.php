@extends('layouts.app')

@section('title', 'Edit Student')

@section('style')
    {!! Html::style('css/parsley.css') !!}
@endsection

@section('content')

    <a href="javascript:history.back()" id="submitbtn" class="btn btn-outline-light">back</a>
    <br><br>
    <h1 class="text-center">Edit Student Information</h1>
    <hr style="margin-bottom:50px;">
    {!! Form::open(['action' => ['StudentController@update', $student->id], 'method' => 'POST', 'files' => true, 'data-parsley-validate' => '']) !!}
        {{Form::hidden('batch', $student->batch)}}

        <div class="form-row">
            <div class="form-group col-md-6">
                {{Form::label('fname', 'Firstname')}}
                {{Form::text('fname', $student->fname, ['id' => 'name1', 'class' => 'form-control', 'placeholder' => 'Firstname', 'required' => '', 'autocomplete' => 'off'])}}
            </div>
            <div class="form-group col-md-6">
                {{Form::label('lname', 'Lastname')}}
                {{Form::text('lname', $student->lname, ['id' => 'name2', 'class' => 'form-control', 'placeholder' => 'Lastname', 'required' => ''])}}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                {{Form::label('bday', 'Birth-date')}}
                {{Form::date('bday', $student->bday, ['class' => 'form-control', 'placeholder' => 'xx-xx-xxxx', 'required' => ''])}}
            </div>
            <div class="form-group col-md-6">
                {{Form::label('age', 'Age')}}
                {{Form::number('age', $student->age, ['class' => 'form-control', 'placeholder' => 'Age', 'required' => ''])}}
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                {{Form::label('jobexp', 'Job Experience (*Optional)')}}
                {{Form::text('jobexp', $student->jobexp, ['class' => 'form-control', 'placeholder' => 'Call center experience'])}}
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                {{Form::label('contact', 'Contact#')}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text">+63</span>
                    </div>
                    {{Form::number('contact', $student->contact, ['id' => 'contact', 'class' => 'form-control', 'placeholder' => '10 Digit number', 'required' => ''])}}
                </div>
            </div>
            <div class="form-group col-md-6">
                {{Form::label('email', 'E-mail')}}
                {{Form::email('email', $student->email, ['class' => 'form-control', 'placeholder' => 'sample@sample.com', 'required' => ''])}}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                {{Form::label('attainment', 'Educational Attainment')}}
                {{Form::text('attainment', $student->attainment, ['class' => 'form-control', 'placeholder' => 'Highest educational attainment', 'required' => ''])}}
            </div>
            <div class="form-group col-md-6">
                {{Form::label('school', 'School')}}
                {{Form::text('school', $student->school, ['class' => 'form-control', 'placeholder' => 'School', 'required' => ''])}}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                {{Form::label('nickname', 'Nickname')}}
                {{Form::text('nickname', $student->nickname, ['class' => 'form-control', 'placeholder' => 'Nickname', 'required' => ''])}}
            </div>
            <div class="form-group col-md-6">
                {{Form::label('sched_in', 'Time Schedule')}}
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        {{Form::text('sched_in', date('H:i', strtotime($student->sched_in)), ['id' => 'time1', 'class' => 'form-control', 'placeholder' => 'AM', 'required' => '', 'maxlength' => '5'])}}
                    </div>
                    <div class="col-md-2">To</div>
                    <div class="col-md-3">
                        {{Form::text('sched_out', date('H:i', strtotime($student->sched_out)), ['id' => 'time2', 'class' => 'form-control', 'required' => '', 'placeholder' => 'PM', 'maxlength' => '5'])}}
                    </div>
                </div>
            </div>
        </div>
        <br>
        {{Form::hidden('_method', 'PUT')}}
        <center>{{Form::submit('Update Student', ['class' => 'btn btn-outline-light', 'id' => 'submitbtn'])}}</center>
    {!! Form::close() !!}        
@endsection

@section('javascript')
    {!! Html::script('js/parsley.min.js') !!}
@endsection

@section('jquery')
    $('#time1').keydown(function (e) {
       var key = e.charCode || e.keyCode || 0;
       $text = $(this); 
       if (key !== 8 && key !== 9) {
           if ($text.val().length === 2) {
               $text.val($text.val() + ':');
           }
       }
       return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
   })

   $('#time2').keydown(function (e) {
       var key = e.charCode || e.keyCode || 0;
       $text = $(this); 
       if (key !== 8 && key !== 9) {
           if ($text.val().length === 2) {
               $text.val($text.val() + ':');
           }
       }
       return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
   })

   $('#name1').keydown(function (e) {
        if (e.ctrlKey || e.altKey) {
            e.preventDefault();       
        } else {   
            var key = e.keyCode;
            if (!((key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
            e.preventDefault();
            }
        }    
    });

    $('#name2').keydown(function (e) {
        if (e.ctrlKey || e.altKey) {
            e.preventDefault();       
        } else {   
            var key = e.keyCode;
            if (!((key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
            e.preventDefault();
            }
        }    
    });

    var element = document.getElementById('contact');

    $("#contact").keydown(function (event) {
        // Allow only backspace and delete

        if($(this).val().length <= 9 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 )
        {
            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
                // let it happen, don't do anything
            } else {
                // Ensure that it is a number and stop the keypress
                if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                    event.preventDefault();
                }
            }
        }else{
            event.preventDefault();
        }
    });
@endsection