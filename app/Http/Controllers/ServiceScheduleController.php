<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceSchedule;
use Illuminate\Http\Request;

class ServiceScheduleController extends Controller
{
    /**
     * Schedule List
     */
    public function index()
    {
        $schedules = ServiceSchedule::with('service')
            ->latest()
            ->get();

        return view(
            'backend.service_schedule_section.index',
            compact('schedules')
        );
    }

    /**
     * Create Page
     */
    public function create()
    {
        $services = Service::orderBy('name')->get();

        return view(
            'backend.service_schedule_section.create',
            compact('services')
        );
    }

    /**
     * Store Schedule
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'date'       => 'required|date',
            'time'       => 'required',
        ]);

        ServiceSchedule::create([
            'service_id' => $request->service_id,
            'date'       => $request->date,
            'time'       => $request->time,
            'is_booked'  => $request->is_booked ?? 0,
        ]);

        return redirect()
            ->route('service-schedules.index')
            ->with('success', 'Service Schedule Created Successfully');
    }

    /**
     * Show Schedule
     */
    public function show($id)
    {
        $schedule = ServiceSchedule::with('service')
            ->findOrFail($id);

        return view(
            'backend.service_schedule_section.show',
            compact('schedule')
        );
    }

    /**
     * Edit Page
     */
    public function edit($id)
    {
        $schedule = ServiceSchedule::findOrFail($id);

        $services = Service::orderBy('name')->get();

        return view(
            'backend.service_schedule_section.edit',
            compact('schedule', 'services')
        );
    }

    /**
     * Update Schedule
     */
    public function update(Request $request, $id)
    {
        $schedule = ServiceSchedule::findOrFail($id);

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'date'       => 'required|date',
            'time'       => 'required',
        ]);

        $schedule->update([
            'service_id' => $request->service_id,
            'date'       => $request->date,
            'time'       => $request->time,
            'is_booked'  => $request->is_booked ?? 0,
        ]);

        return redirect()
            ->route('service-schedules.index')
            ->with('success', 'Service Schedule Updated Successfully');
    }

    /**
     * Delete Schedule
     */
    public function destroy($id)
    {
        $schedule = ServiceSchedule::findOrFail($id);

        $schedule->delete();

        return redirect()
            ->route('service-schedules.index')
            ->with('success', 'Service Schedule Deleted Successfully');
    }
}
