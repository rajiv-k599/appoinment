<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->type == "Patient")
        {
          $users =  DB::table('users')->where('type', 'Doctor')->get();
          return view('home', ['users' => $users]);
        } else {
            $today = Carbon::today()->toDateString();
            $results = Appointment::where('doctor_id',Auth::User()->id)
                                ->whereDate('appointment_datetime',$today)
                                ->join('Users', 'users.id', '=', 'appointments.user_id')
                                ->select('appointments.*', 'Users.name', 'Users.address')
                                ->get();
                             
           return view('doctorhome', ['results' => $results]); 
        }
        
    }

    public function appointment($id)
    {
    
        $doctor = DB::table('users')->where('type', 'Doctor')->where('id', $id)->first();
        return view('appointment.appointment', ['doctor' => $doctor]);
    }

    public function appoint(Request $request)
    {  
          $request->validate([
                'appointment_datetime' => 'required|date',
                // Add other validation rules as needed
            ]);

            $appointmentDateTime = Carbon::parse($request->appointment_datetime);

            // Check if the appointment date is today or less than today
            if ($appointmentDateTime->isToday() || $appointmentDateTime->isPast()) {
                return redirect()->back()->with('error', 'Appointment date should be in the future.');
            }

            // Check if the appointment date is already booked
            $existingAppointment = Appointment::where('appointment_datetime', $request->appointment_datetime)->where('id', $request->doctor_id)->first();
            if ($existingAppointment) {
                return redirect()->back()->with('error', 'Appointment date is already booked.');
            }

            // If all validations pass, create the appointment
            Appointment::create($request->all());

            return redirect()->back()->with('success', 'Appointment created successfully.');
    }
    
    public function history()
    {
        $histories = Appointment::where('user_id',Auth::User()->id)
                                ->join('Users', 'users.id', '=', 'appointments.doctor_id')
                                ->select('appointments.*', 'Users.name', 'Users.specialization')
                                ->get();
        
        return view('appointment.history',['histories' => $histories]);
    }
     public function doctorHistory()
    {
        $histories = Appointment::where('doctor_id',Auth::User()->id)
                                ->join('Users', 'users.id', '=', 'appointments.user_id')
                                ->select('appointments.*', 'Users.name', 'Users.address')
                                ->get();
        
        return view('appointment.doctorHistory',['histories' => $histories]);
    }


}
