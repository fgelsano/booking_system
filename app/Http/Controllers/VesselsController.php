<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\Log;

class VesselsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Vessel::latest()->get();
            // dd($data);
            return DataTables::of($data)->make(true);
        }
        return view('admin.settings.vessels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.vessels.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $this->validateData($request);
        // dd($validateData);
        $vesselImg = $request->file('vessel_img');
        
        if($vesselImg){
            $destinationPath = public_path('storage/vessel-images');;
            $profileImage = date('YMdHis') . "-" . $vesselImg->getClientOriginalName() . "." . $vesselImg->getClientOriginalExtension();
            
            $validateData['vessel_img'] = $profileImage;
        } else {
            $validateData['vessel_img'] = 'No Image uploaded';
        }
        // dd($validateData);
        $vessel = Vessel::create($validateData);
        if($vessel){
            $vesselImg->move($destinationPath, $profileImage);
        }
        // $vessel = new Vessel;
        // $vessel->vessel_name = $input['vessel-name'];
        // $vessel->vessel_capacity = $input['vessel-capacity'];
        // $vessel->vessel_img = $input['vessel-img'];
        // $vessel->save();
        return response()->json([
            'success' => true, 
            'message' => 'Vessel successfully added',
            'data' => $vessel
        ])->header('Content-Type','application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $vessel = Vessel::find($id);
            return response()->json(['vessel' => $vessel]);
        } else {
            abort(404);
        }
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
        dd($request, $id);
        $validateData = $this->validateData($request);
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

    public function validateData($request)
    {
        return $request->validate([
            'vessel_name' => 'required|string|max:255',
            'vessel_capacity' => 'required|max:5',
            'vessel_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
}
