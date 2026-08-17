<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    /**
     * Display all services
     */
    public function index()
    {
        $services = Service::latest()->get();

        return view(
            'backend.service_section.index',
            compact('services')
        );
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view(
            'backend.service_section.create'
        );
    }

    /**
     * Store service
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required',
            'price'         => 'required|numeric',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'instructions'  => 'nullable|array'
        ]);

        $service = new Service();

        $service->title = $request->title;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->instructions = $request->instructions;

        if ($request->hasFile('image')) {

            $destination = public_path('uploads/images/services');

            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0777, true, true);
            }

            $image = $request->file('image');

            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move($destination, $imageName);

            $service->image = 'uploads/images/services/' . $imageName;
        }

        $service->save();

        return redirect()
            ->route('services.index')
            ->with('success', 'Service Added Successfully');
    }

    /**
     * Show single service
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);

        return view(
            'backend.service_section.show',
            compact('service')
        );
    }

    /**
     * Edit form
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return view(
            'backend.service_section.edit',
            compact('service')
        );
    }

    /**
     * Update service
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required',
            'price'         => 'required|numeric',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'instructions'  => 'nullable|array'
        ]);

        $service->title = $request->title;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->instructions = $request->instructions;

        if ($request->hasFile('image')) {

            if (
                $service->image &&
                File::exists(public_path($service->image))
            ) {

                File::delete(public_path($service->image));
            }

            $destination = public_path('uploads/images/services');

            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0777, true, true);
            }

            $image = $request->file('image');

            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move($destination, $imageName);

            $service->image = 'uploads/images/services/' . $imageName;
        }

        $service->save();

        return redirect()
            ->route('services.index')
            ->with('success', 'Service Updated Successfully');
    }

    /**
     * Delete service
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if (
            $service->image &&
            File::exists(public_path($service->image))
        ) {

            File::delete(public_path($service->image));
        }

        $service->delete();

        return redirect()
            ->route('services.index')
            ->with('success', 'Service Deleted Successfully');
    }
}
