<?php

namespace App\Http\Controllers;

use App\Models\Port;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\Log;

class PortsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ports = Port::latest()->get();
            // dd($data);
            return DataTables::of($ports)->make(true);
        }
        return view('admin.settings.ports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.ports.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'port_name' => 'required|max:255',
            'pier_number' => 'required|integer',
        ]);
    
        $ports = new Port;
        $ports->name = $validatedData['port_name'];
        $ports->pier_number = $validatedData['pier_number'];
        $ports->save();
    
        return redirect()->route('ports.index')->with('success', 'Port created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ports = Port::find($id);
        return response()->json(['data' => $ports]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ports = Port::findOrFail($id);

        return response()->json([
            'data' => $ports,
            'message' => 'Port data retrieved successfully'
        ]);
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
        // log the request data
        Log::debug('Request data:', $request->all());

        // get the input values
        $name = $request->input('edit-ports-name');
        $pier_number = $request->input('edit-pier-number');

        // log the input values
        Log::debug('Input values:', [
            'name' => $name,
            'pier_number' => $pier_number,
        ]);

        // update the ports data in the database
        $ports = Port::find($id);
        $ports->name = $name;
        $ports->pier_number = $pier_number;
        $ports->save();
        
        
        return view('admin.settings.ports.index')->with('success', 'Ports loaded successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ports = Port::findOrFail($id);
        $ports->delete();
    }
}
