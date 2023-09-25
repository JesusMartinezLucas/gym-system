<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments;
        if(Auth::user()->is_admin)
            $appointments = Appointment::orderBy('date', 'ASC')->paginate(10); 
        else
            $appointments = Auth::user()->appointments()->orderBy('date', 'ASC')->paginate(10);

        return view('appointments.index', ['appointments' => $appointments, 'isAdmin' => Auth::user()->is_admin]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = Carbon::now()->format('Y-m-d\TH:i');
        return view('appointments.create', ['now' => $now]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after:now',
            'duration' => 'numeric|required'
        ]);

        $dateFrom = $request->input('date');
        $dateTo = Carbon::parse($request->input('date'))->addHours($request->input('duration'))->subSeconds(1)->format('Y-m-d\TH:i');
        $available = Appointment::where('date', '<=', $dateFrom)->where('end_date', '>=', $dateFrom)->get()->isEmpty();
        $available = $available && Appointment::where('date', '<=', $dateTo)->where('end_date', '>=', $dateTo)->get()->isEmpty();

        if(!$available){
            return redirect(route('appointments.create'))->with("error", "No hay citas disponibles en la fecha y hora seleccinada.");
        }

        $appointment = new Appointment();
        $appointment->date = $request->input('date');
        $appointment->end_date = $dateTo;
        $appointment->duration = $request->input('duration');
        $appointment->user_id = Auth::user()->id;
        $appointment->save();

        return view("appointments.message", ['msg' => "Cita agendada"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $now = Carbon::now()->format('Y-m-d\TH:i');
        $appointment = Appointment::find($id);
        return view('appointments.edit', ['appointment' => $appointment, 'now' => $now]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date|after:now',
            'duration' => 'numeric|required'
        ]);

        $dateFrom = $request->input('date');
        $dateTo = Carbon::parse($request->input('date'))->addHours($request->input('duration'))->subSeconds(1)->format('Y-m-d\TH:i');
        $available = Appointment::where('id', '!=', $id)
            ->where('date', '<=', $dateFrom)->where('end_date', '>=', $dateFrom)
            ->get()->isEmpty();
        $available = $available && 
            Appointment::where('id', '!=', $id)
            ->where('date', '<=', $dateTo)->where('end_date', '>=', $dateTo)
            ->get()->isEmpty();

        if(!$available){
            return redirect(route('appointments.create'))->with("error", "No hay citas disponibles en la fecha y hora seleccinada.");
        }

        $appointment = Appointment::find($id);
        $appointment->date = $request->input('date');
        $appointment->end_date = $dateTo;
        $appointment->duration = $request->input('duration');
        $appointment->save();

        return view("appointments.message", ['msg' => "Cita modificada"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();

        return redirect("appointments");
    }
}
