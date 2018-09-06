<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Batch;
use App\Student;
use Session;
use DB;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::all();
        
        return view('batch.batch')->with('batches', $batches);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('batch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'start'         => 'required'
        ]);

        $batch = new Batch;
        $batch->studcount = $request->input('studcount');
        $batch->start = $request->input('start');
        
        $batch->save();

        Session::flash('success', 'Batch Created!');

        return redirect('/batch');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $batch = Batch::find($request->batch_id);
        $query = Student::all()->where('batch', $request->batch_id);

        if($query == '[]'){

            $batch->delete();

            Session::flash('success', 'Batch Deleted Successfully!');
            return redirect('/batch');
        }else{
            Session::flash('error', 'You cant delete a batch with data inside!');
            return redirect('/batch');
        }
        
    }
}
