<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Batch;
use Session;
use DB;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::all();
        return view('student.students')->with('student', $student);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'photo'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fname'         => 'required',
            'lname'         => 'required',
            'age'           => 'required',
            'bday'          => 'required',
            'email'         => 'required',
            'contact'       => 'required',
            'attainment'    => 'required',
            'school'        => 'required',
            'nickname'      => 'required'
        ]);
            
        if($request->file('photo') == null){
            $name = 'default.png';
        }else{
            
            $photo = $request->file('photo');
            $name = $request->photo->getClientOriginalName();
            $destinationPath = public_path('/images');
            $photo->move($destinationPath, $name);
        }

        if($request->jobexp == null){
            $request->jobexp = 'none';
        }
        $student = new Student;
        DB::table('batches')->where('id', $request->input('batch'))->increment('studcount');

        $query2 = DB::table('students')->max('id');
        $increment = $query2 + 1;
        
        $student->photo = $request->file.$name;
        $student->studno = $request->studno.$increment;
        $student->batch = $request->input('batch');
        $student->fname = $request->input('fname');
        $student->lname = $request->input('lname');
        $student->bday = $request->input('bday');
        $student->age = $request->input('age');
        $student->jobexp = $request->jobexp;
        $student->contact = $request->input('contact');
        $student->email = $request->input('email');
        $student->attainment = $request->input('attainment');
        $student->school = $request->input('school');
        $student->nickname = $request->input('nickname');
        $student->sched_in = $request->input('sched_in');
        $student->sched_out = $request->input('sched_out');
        $student->save();

        Session::flash('success', 'Student Successfully Registered!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::all();
        $batch = Batch::find($id);
        return view('student.students')->with(['student'=> $student, 'batch' => $batch]);
    }

 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('student.edit')->with('student', $student);
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
        $this->validate($request, [
            'fname'         => 'required',
            'lname'         => 'required',
            'age'           => 'required',
            'bday'          => 'required',
            'email'         => 'required',
            'contact'       => 'required',
            'attainment'    => 'required',
            'school'        => 'required',
            'nickname'      => 'required',
            'sched_in'      => 'required',
            'sched_out'     => 'required'
        ]);

        DB::table('students')
            ->where('id', $id)
            ->update([
                'fname'     =>  $request->fname,
                'lname'     =>  $request->lname,
                'bday'      =>  $request->bday,
                'age'       =>  $request->age,
                'jobexp'    =>  $request->jobexp,
                'contact'   =>  $request->contact,
                'email'     =>  $request->email,
                'attainment'=>  $request->attainment,
                'school'    =>  $request->school,
                'nickname'  =>  $request->nickname,
                'sched_in'  =>  $request->sched_in,
                'sched_out' =>  $request->sched_out
                ]);

        Session::flash('success', '"'.$request->fname.'" Information Updated Successfully!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $student = Student::find($request->student_id);
        DB::table('batches')->where('id','=', $request->student_batch)->decrement('studcount');
        $student->delete();
        Session::flash('success', '"'.$student->fname.'" Has Been Deleted Successfully!');
        return redirect()->back();
    }

    public function changepic(Request $request)
    {
        if($request->file('photo') == null){
            $name = 'default.png'; 
        }else{
            
            $photo = $request->file('photo');
            $name = $request->photo->getClientOriginalName();
            $destinationPath = public_path('/images');
            $photo->move($destinationPath, $name);
        }

        DB::table('students')
            ->where('id', $request->student_id)
            ->update([
                'photo' => $request->file.$name
            ]);

        Session::flash('success', 'Profie Picture Updated!');

        return redirect()->back();
    }

}
