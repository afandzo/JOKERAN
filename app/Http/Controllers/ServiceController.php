<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('service', [
            'services' => Service::all(),
            'active' => 'service'
        ]);
    }

    public function tambahDataService(Request $request)
    {
        // dd($request->all());
        Service::create($request->all());
        return redirect()->route('service')->with('success', 'Data added successfully!');
    }

    public function updateDataService(Request $request, $id)
    {
        $service = Service::find($id);
        $service->update($request->all());
        return redirect()->route('service')->with('success', 'Data updated successfully!');
    }

    public function deleteDataService($id)
    {
        $service = Service::find($id);
        $service->delete();
        return redirect()->route('service')->with('success', 'Data deleted successfully!');
    }
}
