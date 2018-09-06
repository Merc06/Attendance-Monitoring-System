@extends('layouts.app')

@section('title', 'Batch')

@section('content')
    <h1 class="text-center">Attendance Monitoring System</h1>
    <br>
    <center>
        <a href="#" id="submitbtn" data-toggle="modal" data-target="#addbatch" class="btn btn-outline-light">Add Batch</a>
        <br><br>
        <div id="print"></div>
    </center>
    <table id="example" class="table table-bordered table-hover" style="width:100%">
        <thead>
        <tr>
            <th>Batch#</th>
            <th># of Student</th>
            <th>Start Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @if(count($batches) > 0)
            @foreach($batches as $batch)
                <tr>
                    <td>Batch {{ $batch-id }}</td>
                    <td>{{ $batch->studcount }}</td>
                    <td>{{ $batch->start }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-success btn-sm" href="/students/{{$batch->id}}">Open</a>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletebatch" 
                            data-batchid={{$batch->id}}>Delete</button>
                        </div>
                    </td>
                </tr>
            @endforeach
            @else
                <h3>No Batch Yet!</h3> 
            @endif 
        </tbody>
    </table>
    <br><br><br>

    <!-- Modal Delete Batch -->
    <div class="modal fade" id="deletebatch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Confirmation!</h6>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">No</button>
                @if(count($batches) > 0)
                {!! Form::open(['action' => ['BatchController@destroy', 'test'], 'method' => 'POST']) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::hidden('batch_id', '', ['id' => 'b_id'])}}
                    {{Form::submit('Yes', ['class' => 'btn btn-danger btn-sm'])}}
                {!! Form::close() !!}
                @endif
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Batch -->
    <div class="modal fade" id="addbatch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Add Batch!</h6>
            </div>
            <div class="modal-body">

                <?php 
                    date_default_timezone_set('Asia/Manila');
                    $date = date('Y-m-d');
                ?>

                {!! Form::open(['action' => 'BatchController@store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::hidden('studcount', '0')}}
                        {{Form::label('start', 'Start Date')}}
                        {{Form::date('start', '', ['class' => 'form-control', 'min' => $date, 'placeholder' => 'Start Date'])}}
                    </div>
                    <br>
                    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    {{Form::submit('Submit', ['class' => 'btn btn-success btn-sm'])}}
                {!! Form::close() !!}
            </div>
            </div>
        </div>
    </div>

@endsection

@section('jquery')

    $('#deletebatch').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var batch_id = button.data('batchid');
        var modal = $(this);
        modal.find('.modal-footer #b_id').val(batch_id);
    });

@endsection