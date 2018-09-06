@extends('layouts.app')

@section('title', 'Students')

@section('style')
    {!! Html::style('css/parsley.css') !!}
@endsection

<?php 
    $date = date('m-d-Y');
?>

@section('content')

    <h1 class="text-center">Student/s of Batch {{$batch->id}}</h1>
    <br>
    <center>
        <a href="#" data-toggle="modal" id="submitbtn" data-target="#myModal" class="btn btn-outline-light">Register Student</a>
        <br><br>
        <div id="print"></div>
    </center>
    <table id="example" class="table table-hover table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Student#</th>
            <th>Full Name</th>
            <th>Contact Number</th>
            <th>Bday</th>
            <th>Age</th>
            <th>Action</th> 
        </tr>
        </thead>
        <tbody>
        @if(count($student) > 0)
            @foreach($student as $student)
                @if($student->batch == $batch->id)
                <tr>
                    <td>{{ $student->studno }}</td>
                    <td>{{ $student->lname }}, {{ $student->fname }}</td>
                    <td>+63 {{ $student->contact }}</td>
                    <td>{{ $student->bday }}</td>
                    <td>{{ $student->age }}</td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/attendance/{{$student->id}}" class="btn btn-success btn-sm">View</a>
                        <a href="/students/{{$student->id}}/edit" class="btn btn-info btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete" 
                        data-studid={{$student->id}} data-studbatch={{$student->batch}}>Delete</button>
                    </div>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
        @else
            <h3>No Students Yet!</h3> 
        @endif 
    </table>

    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation!</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">No</button>
                @if(count($student) > 0)
                {!! Form::open(['method' => 'POST', 'route' => ['students.destroy', 'test']]) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::hidden('student_id', '', ['id' => 'stud_id'])}}
                    {{Form::hidden('student_batch', '', ['id' => 'stud_batch'])}}
                    {{Form::submit('Yes', ['class' => 'btn btn-danger btn-sm'])}}
                {!! Form::close() !!}
                @endif
            </div>
            </div>
        </div>
    </div>
 
    <!-- The Modal Register Student-->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="text-center">Student Registration</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <div class="modal-body">
                {!! Form::open(['action' => 'StudentController@store', 'method' => 'POST', 'files' => true, 'data-parsley-validate' => '']) !!}
                    {{Form::hidden('studno', $date.'-')}}
                    {{Form::hidden('batch', $batch->id)}}
                    <div class="row">
                        <div class="col-md-6">
                            {{Form::label('photo', 'Upload Picture',['class' => 'control-label'])}}
                            {{Form::file('photo', ['class' => 'form-control-file'])}}
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {{Form::label('fname', 'Firstname')}}
                            {{Form::text('fname', '', ['id' => 'name1', 'class' => 'form-control', 'placeholder' => 'Firstname', 'required' => '', 'autocomplete' => 'off'])}}
                        </div>
                        <div class="form-group col-md-6">
                            {{Form::label('lname', 'Lastname')}}
                            {{Form::text('lname', '', ['id' => 'name2', 'class' => 'form-control', 'placeholder' => 'Lastname', 'required' => '', 'autocomplete' => 'off'])}}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {{Form::label('bday', 'Birth-date')}}
                            {{Form::date('bday', '', ['class' => 'form-control', 'id' => 'b_day', 'required' => '', 'autocomplete' => 'off'])}}
                        </div>
                        <div class="form-group col-md-6">
                            {{Form::label('age', 'Age')}}
                            {{Form::number('age', '', ['class' => 'form-control', 'id' => 'ageauto', 'placeholder' => 'Age', 'required' => '', 'autocomplete' => 'off'])}}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {{Form::label('jobexp', 'Job Experience (*Optional)')}}
                            {{Form::text('jobexp', '', ['class' => 'form-control', 'placeholder' => 'Call center experience', 'autocomplete' => 'off'])}}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {{Form::label('contact', 'Contact#')}}
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">+63</span>
                                </div>
                                {{Form::number('contact', '', ['id' => 'contact', 'class' => 'form-control', 'placeholder' => '10 Digit number', 'required' => '', 'maxlength' => '11', 'autocomplete' => 'off'])}}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            {{Form::label('email', 'E-mail')}}
                            {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'sample@sample.com', 'required' => '', 'autocomplete' => 'off'])}}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {{Form::label('attainment', 'Educational Attainment')}}
                            {{Form::text('attainment', '', ['class' => 'form-control', 'placeholder' => 'Highest educational attainment', 'required' => '', 'autocomplete' => 'off'])}}
                        </div>
                        <div class="form-group col-md-6">
                            {{Form::label('school', 'School')}}
                            {{Form::text('school', '', ['class' => 'form-control', 'placeholder' => 'School', 'required' => '', 'autocomplete' => 'off'])}}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {{Form::label('nickname', 'Nickname')}}
                            {{Form::text('nickname', '', ['class' => 'form-control', 'placeholder' => 'Nickname', 'required' => '', 'autocomplete' => 'off'])}}
                        </div>
                        <div class="form-group col-md-6">
                            {{Form::label('sched_in', 'Time Schedule')}}
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    {{Form::text('sched_in', '', ['id' => 'time1', 'class' => 'form-control', 'placeholder' => 'AM', 'required' => '', 'maxlength' => '5', 'autocomplete' => 'off'])}}
                                </div>
                                <div class="col-md-2">To</div>
                                <div class="col-md-3">
                                    {{Form::text('sched_out', '', ['id' => 'time2', 'class' => 'form-control', 'required' => '', 'placeholder' => 'PM', 'maxlength' => '5', 'autocomplete' => 'off'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">                   
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    {{Form::submit('Register', ['class' => 'btn btn-success btn-sm'])}}
                {!! Form::close() !!}
            </div>
            
        </div>
        </div>
    </div>

@endsection

@section('javascript')
    {!! Html::script('js/parsley.min.js') !!}
@endsection

@section('jquery')

    $('#delete').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var student_id = button.data('studid');
        var student_batch = button.data('studbatch');
        var modal = $(this);
        modal.find('.modal-footer #stud_id').val(student_id);
        modal.find('.modal-footer #stud_batch').val(student_batch);
    });

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
