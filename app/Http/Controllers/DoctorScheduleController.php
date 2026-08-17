<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;

class DoctorScheduleController extends Controller
{
    /**
     * Schedule List
     */
    public function index()
    {
        $schedules = DoctorSchedule::with('doctor')
            ->latest()
            ->get();

        return view(
            'backend.schedule_section.index',
            compact('schedules')
        );
    }

    /**
     * Create Page
     */
    public function create()
    {
        $doctors = Doctor::orderBy('name')->get();

        return view(
            'backend.schedule_section.create',
            compact('doctors')
        );
    }

    /**
     * Store Schedule
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'date'      => 'required|date',
            'time'      => 'required',
        ]);

        DoctorSchedule::create([
            'doctor_id' => $request->doctor_id,
            'date'      => $request->date,
            'time'      => $request->time,
            'is_booked' => $request->is_booked ?? 0,
        ]);

        return redirect()
            ->route('doctor-schedules.index')
            ->with('success', 'Doctor Schedule Created Successfully');
    }

    /**
     * Show Schedule
     */
    public function show($id)
    {
        $schedule = DoctorSchedule::with('doctor')
            ->findOrFail($id);

        return view(
            'backend.schedule_section.show',
            compact('schedule')
        );
    }

    /**
     * Edit Page
     */
    public function edit($id)
    {
        $schedule = DoctorSchedule::findOrFail($id);

        $doctors = Doctor::orderBy('name')->get();

        return view(
            'backend.schedule_section.edit',
            compact('schedule', 'doctors')
        );
    }

    /**
     * Update Schedule
     */
    public function update(Request $request, $id)
    {
        $schedule = DoctorSchedule::findOrFail($id);

        $request->validate([
            'doctor_id' => 'required',
            'date'      => 'required|date',
            'time'      => 'required',
        ]);

        $schedule->update([
            'doctor_id' => $request->doctor_id,
            'date'      => $request->date,
            'time'      => $request->time,
            'is_booked' => $request->is_booked ?? 0,
        ]);

        return redirect()
            ->route('doctor-schedules.index')
            ->with('success', 'Doctor Schedule Updated Successfully');
    }

    /**
     * Delete Schedule
     */
    public function destroy($id)
    {
        $schedule = DoctorSchedule::findOrFail($id);

        $schedule->delete();

        return redirect()
            ->route('doctor-schedules.index')
            ->with('success', 'Doctor Schedule Deleted Successfully');
    }
}
