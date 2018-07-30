<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Attendance;
use App\Student;
use DB;
use Session;
use Carbon\Carbon;
use Stevebauman\Location\Position;
use Stevebauman\Location\Drivers\Driver;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('attendance.attendance');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $time = date('H:i:s');
        $date = date('Y-m-d');

        $attendance = new Attendance;
        $query = DB::table('students')->where('studno', $request->input('stud_id'))->get();

        foreach ($query as $student) {
            $singleData['id'] = $student->id;
            $singleData['sched_in'] = $student->sched_in;
        }
        if(Input::get('time_in')){
        
            if($query == '[]'){
                
                Session::flash('error', 'Student ID not reistered yet!');  
                return redirect('/attendance');
    
            }else{
                $query2 = DB::table('attendances')
                            ->where(['studentid' => $singleData['id'], 'date' => $date])
                            ->get();

                foreach ($query2 as $attend) {
                    $data['date'] = $attend->date;
                    $data['in_am'] = $attend->in_am;
                    $data['in_pm'] = $attend->in_pm;
                    $data['out_am'] = $attend->out_am;
                    $data['out_pm'] = $attend->out_pm;
                }

                $user_ip = getenv('REMOTE_ADDR');
                $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
                $city = $geo['geoplugin_city'];
                $region = $geo['geoplugin_regionName'];
                $loc = $city.' '.$region;

                if($query2 == '[]'){
                    if($time <= '12:00:00'){
                        $attendance->studentid = $singleData['id'];
                        $attendance->in_am = $time;
                        $attendance->out_am = '00:00:00';
                        $attendance->in_pm = '00:00:00';
                        $attendance->out_pm = '00:00:00';
                        $attendance->date = $date;
                        $attendance->totalhrs = '0';
                        $attendance->location = $loc;
                    }else{
                        $attendance->studentid = $singleData['id'];
                        $attendance->in_am = '00:00:00';
                        $attendance->out_am = '00:00:00';
                        $attendance->in_pm = $time;
                        $attendance->out_pm = '00:00:00';
                        $attendance->date = $date;
                        $attendance->totalhrs = '0';
                        $attendance->location = $loc;
                    }
            
                    $attendance->save();
        
                    Session::flash('success', 'You are now Log In!');        
                    return redirect('/attendance');
                
                }else{

                    if($data['in_am'] != '00:00:00' && $data['in_pm'] == '00:00:00'){

                        if($data['out_am'] == '00:00:00'){
                            Session::flash('error', 'You are already Logged In!');       
                            return redirect('/attendance');
                        }else{
                            DB::table('attendances')
                                ->where(['studentid' => $singleData['id'], 'date' => $date])
                                ->update([
                                    'in_pm' => $time,
                                    ]); 

                            Session::flash('success', 'You are now Log In!');        
                            return redirect('/attendance');
                        }

                    }else{

                        if($data['in_pm'] != '00:00:00' && $data['out_pm'] == '00:00:00'){
                            Session::flash('error', 'You are already Logged In!');       
                            return redirect('/attendance');
                        }else{
                            Session::flash('error', 'You are already out, please back on the other day!');       
                            return redirect('/attendance');
                        }
                        
                    }
                }
            } 

        }else{
            //DITO YUNG TIME-OUT!
            if($query == '[]'){
                
                Session::flash('error', 'Student ID not reistered yet!');  
                return redirect('/attendance');
    
            }else{

                $query3 = DB::table('attendances')
                            ->where(['date' => $date, 'studentid' => $singleData['id']])
                            ->get();

                foreach ($query3 as $attend) {
                    $data['in_am'] = $attend->in_am;
                    $data['in_pm'] = $attend->in_pm;
                    $data['out_am'] = $attend->out_am;
                    $data['out_pm'] = $attend->out_pm;
                    $data['date'] = $attend->date;
                }
                if($query3 == '[]'){

                    Session::flash('error', 'You are not Log In yet!');        
                    return redirect('/attendance');

                }else{
                    $hours = date('H');

                    if($data['in_am'] != '00:00:00' && $data['in_pm'] == '00:00:00'){
                        DB::table('attendances')
                                ->where(['studentid' => $singleData['id'], 'date' => $date])
                                ->update([
                                    'out_am' => $time,
                                    ]);
                    }else{
                        DB::table('attendances')
                                ->where(['studentid' => $singleData['id'], 'date'=> $date])
                                ->update([
                                    'out_pm' => $time,
                                    ]);
                    }
      
                    $query4 = DB::table('attendances')
                            ->where(['date' => $date, 'studentid' => $singleData['id']])
                            ->get();

                    foreach ($query4 as $attendnew) {
                        $datanew['in_am'] = $attendnew->in_am;
                        $datanew['in_pm'] = $attendnew->in_pm;
                        $datanew['out_am'] = $attendnew->out_am;
                        $datanew['out_pm'] = $attendnew->out_pm;
                        $datanew['date'] = $attendnew->date;
                    }

                    if($datanew['in_pm'] != '00:00:00' && $datanew['out_pm'] != '00:00:00'){

                        $t1 = Carbon::createFromFormat('H:i:s', $singleData['sched_in']);
                        $t2 = Carbon::createFromFormat('H:i:s', $datanew['out_am']);
                        $t3 = Carbon::createFromFormat('H:i:s', $datanew['in_pm']);
                        $t4 = Carbon::createFromFormat('H:i:s', $datanew['out_pm']);

                        $diff1 = $t1->diffInSeconds($t2);
                        $diff2 = $t3->diffInSeconds($t4);

                        $total = gmdate('H:i', $diff1 + $diff2);

                        DB::table('attendances')
                            ->where(['studentid' => $singleData['id'], 'date' => $date])
                            ->update([
                                'totalhrs'  => $total
                                ]);

                    }else{
                        if($datanew['in_am'] == '00:00:00'){
                            $t3 = Carbon::createFromFormat('H:i:s', $datanew['in_pm']);
                            $t4 = Carbon::createFromFormat('H:i:s', $datanew['out_pm']);
                            $total = $t3->diffInSeconds($t4);
                            $total_hours = gmdate('H:i', $total);
                            DB::table('attendances')
                                ->where(['studentid' => $singleData['id'], 'date' => $date])
                                ->update([
                                    'totalhrs'  => $total_hours
                                    ]);
                        }else{
                            $t1 = Carbon::createFromFormat('H:i:s', $singleData['sched_in']);
                            $t2 = Carbon::createFromFormat('H:i:s', $datanew['out_am']);
                            $total = $t1->diffInSeconds($t2);
                            $total_hours = gmdate('H:i', $total);
                            DB::table('attendances')
                                ->where(['studentid' => $singleData['id'], 'date' => $date])
                                ->update([
                                    'totalhrs'  => $total_hours
                                    ]);
                        }    
                    }
                    Session::flash('success', 'You are now Log Out!');        
                    return redirect('/attendance');
                }    
            }
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attendance = DB::table('attendances')
            ->join('students', 'students.id', '=', 'attendances.studentid')
            ->get();

        $student = Student::find($id);
        return view('attendance.index')->with(['student'=> $student, 'attendance' => $attendance]);
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
    public function destroy($id)
    {
        //
    }
}
