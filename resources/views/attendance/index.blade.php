@extends('layouts.app')

@section('title', 'Students')

@section('content')

<div class="row">
    <div class="col-md-5">
        <a href="#">
            <img src="/images/{{ $student->photo }}" class="float-right" data-toggle="modal" data-target="#changepic" data-studid={{$student->id}} alt="Profile Picture" width="140px" height="140px" style="padding:2px; border-radius:50%; background-color:white;">
        </a>
    </div>
    <div class="col-md-6" style="padding:10px;">
        <h1>{{ $student->fname }} {{ $student->lname }}</h1>
        <h5>{{ $student->studno }}</h5>
        <br><br>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="changepic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Profile Picture!</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'files' => true, 'route' => ['changepic', 'test']]) !!}
                    <input type="file" class="form-control-file" name="photo">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>   
                    {{Form::hidden('_method', 'GET')}}
                    {{Form::hidden('student_id', '', ['id' => 'stud_id'])}}
                    {{Form::submit('Update', ['class' => 'btn btn-success btn-sm'])}}
                {!! Form::close() !!}
            </div>
            </div>
        </div>
    </div>

<center><div id="print"></div></center>
<table id="example" class="table table-hover table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>Date</th>
        <th>Location</th>
        <th>Schedule</th>
        <th>Time In(AM)</th>
        <th>Time Out(AM)</th>
        <th>Time In(PM)</th>
        <th>Time Out(PM)</th>
        <th>Hour/s</th>
        <th>Status</th>    
    </tr>
    </thead>
    <tbody>
    @if(count($attendance) > 0)
        <?php 
            $sum = 0;
            $late = 0; 
            date_default_timezone_set('Asia/Manila');
            $time = date('H:i:s');
        ?>
        @foreach($attendance as $attendance)
        @if($attendance->studno == $student->studno)
        <tr>
            <td>{{ $attendance->date }}</td>
            <td>{{ $attendance->location }}</td>
            <td>{{ $attendance->sched_in }} - {{ $attendance->sched_out }}</td>
            <td>{{ $attendance->in_am }}</td>
            <td>{{ $attendance->out_am }}</td>
            <td>{{ $attendance->in_pm }}</td>
            <td>{{ $attendance->out_pm }}</td>
            <td>
                <?php 
                    echo date('H.i', strtotime($attendance->totalhrs));
                ?>
            </td>
            <td>
                @if($attendance->in_am > $attendance->sched_in)
                    <?php
                        $t1 = date('H.i', strtotime($attendance->in_am));
                        $t2 = date('H.i', strtotime($attendance->sched_in));
                        $dif = date('H.i', strtotime($t1 - $t2));
                            echo '<p style="color:red; font-weight:bold;">LATE</p>'.$dif.'';
                    ?>
                @else
                    @if($attendance->in_am == '00:00:00')
                        <?php
                            $dif = date('H.i', strtotime('00:00'));
                            echo '<p style="color:lightblue; font-weight:bold;">HALF DAY</p>'; 
                        ?>
                    @else
                        <?php
                            $dif = date('H.i', strtotime('00:00'));
                            echo '<p style="color:lightblue; font-weight:bold;">EARLY</p>'; 
                        ?>
                    @endif
                @endif
            </td> 
        </tr>
        <?php $sum += date('H.i', strtotime($attendance->totalhrs)); ?>
        <?php $late += date('H.i', strtotime($dif)); ?>
        @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6"></td>
            <td align="right"><strong>TOTAL :</strong></td>
            <td>
                <p style="color:lightgreen; font-weight:bold;">
                <?php 
                    if($sum != 0){
                        echo date('H . i', strtotime($sum));
                    }
                ?>
                </p>
            </td>
            <td>
                <p style="color:red; font-weight:bold;">
                <?php 
                    if($late != 0){
                        echo date('H . i', strtotime($late));
                    }
                    $compute1 = date('H.i', strtotime($sum));
                    $compute2 = date('H.i', strtotime($late));
                    $tot = $compute1 - $compute2;

                ?>
                </p>
            </td>
        </tr>
    </tfoot>
    @else
        <h3>No Attendance Yet!</h3> 
    @endif 
    
</table>

@endsection

@section('jquery')

    $('#changepic').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var student_id = button.data('studid');
        var modal = $(this);
        modal.find('.modal-footer #stud_id').val(student_id);
    });

@endsection


