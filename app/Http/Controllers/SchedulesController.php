<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Vessel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;


use Illuminate\Support\Facades\Log;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $schedules = Schedule::select('schedules.id', 'vessels.vessel_name as vessel_id', 'schedules.origin', 'schedules.destination', 'schedules.departure_date', 'schedules.departure_time')
                ->join('vessels', 'vessels.id', '=', 'schedules.vessel_id')
                ->get();

                return response()->json([
                    'data' => $schedules
                ]);
                
        }

        return view('admin.settings.schedules.index');
    }

    /**
     * Show the form for creating a new resource. 
     *  
     *  
     *  
     *  
     *   
     *  
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $schedules = Schedule::from('schedules')
            ->join('vessels', 'schedules.vessel_id', '=', 'vessels.id')
            ->select('schedules.*', 'vessels.vessel_name')
            ->first();
            
            return response()->json(['data' => $schedules]);

        // return view('admin.settings.schedules.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateDataSchedules($request);
        $schedules = Schedule::create($validatedData);
        
        return response()->json([
            'success' => true,
            'message' => 'Schedule successfully added',
            'data' => $schedules
        ], 200);    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedules = Schedule::join('vessels', 'vessels.id', '=', 'schedules.vessel_id')
        ->select('schedules.*', 'vessels.vessel_name')
        ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $schedules
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $schedules = Schedule::join('vessels', 'vessels.id', '=', 'schedules.vessel_id')
                ->select('schedules.*', 'vessels.vessel_name')
                ->where('schedules.id', $id)
                ->firstOrFail();

            return response()->json(['success' => true, 'data' => $schedules], 200);
            } catch (ModelNotFoundException $e) {
                return response()->json(['success' => false, 'message' => 'Schedule not found'], 404);
            } catch (Exception $e) {
                return response()->json(['success' => false, 'message' => 'Something went wrong. Please try again.'], 500);
        }
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
        $validateData = $this->validateDataSchedules($request);
        $schedules = Schedule::findOrFail($id);


        $schedules->update($validateData);

        return response()->json([
            'success' => true,
            'message' => 'Schedules updated successfully.',
            'data' => $schedules
        ])->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedules = Schedule::findOrFail($id);
        $schedules->delete();
    }
    public function validateDataSchedules($request)
    {
        return $request->validate([
            'vessel_id' => 'required|exists:vessels,id',
            'origin' => 'required',
            'destination' => 'required',
            'departure_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',

        ]);
    }
}
