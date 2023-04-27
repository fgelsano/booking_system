<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accommodation;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Vessel;

class AccomodationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $accommodations = DB::table('accommodations')
                ->join('vessels', 'vessels.id', '=', 'accommodations.vessel_id')
                ->select('accommodations.*', 'vessels.vessel_name')
                ->latest()
                ->get();
            return Datatables::of($accommodations)
                ->addIndexColumn()
                ->addColumn('vessel_name', function ($accommodation) {
                    return $accommodation->vessel_name ?? '-';
                })
                ->addColumn('action', function ($accommodations) {
                    $editUrl = route('accomodations.edit', $accommodations->id);
                    $viewUrl = route('accomodations.show', $accommodations->id);
                    $deleteUrl = route('accomodations.destroy', $accommodations->id);
                    $editButton = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm edit" data-toggle="modal" data-target="#edit-accommodation-modal" data-id="' . $accommodations->id . '"><i class="fa fa-edit"></i>Edit</a>';
                    $viewButton = '<a href="' . $viewUrl . '" class="btn btn-success btn-sm view" data-toggle="modal" data-target="#viewModalss" data-id="' . $accommodations->id . '"}}"><i class="fa fa-eye"></i> View</a>';
                    $deleteButton = '<button type="button" class="btn btn-danger btn-sm delete" data-url="' . $deleteUrl . '" data-id="' . $accommodations->id . '"><i class="fa fa-trash"></i>Delete</button>';
                    return $editButton . ' ' . $viewButton . ' ' . $deleteButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.settings.accomodations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        $accommodations = DB::table('accommodations')
            ->join('vessels', 'accommodations.vessel_id', '=', 'vessels.id')
            ->select('accommodations.*', 'vessels.vessel_name')
            ->first();
        return response()->json([
            'data' => $accommodations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $this->validateDataAccommodation($request);
        $accommodationImg = $request->file('image_path');

        if ($accommodationImg) {
            $destinationPath = public_path('storage/accommodation-images');;
            $profileImage = date('YMdHis') . "-" . $accommodationImg->getClientOriginalName() . "." . $accommodationImg->getClientOriginalExtension();
            $validateData['image_path'] = $profileImage;
        } else {
            $validateData['image_path'] = "No Image uploaded";
        }

        $accommodations = Accommodation::create($validateData);
        if ($accommodations) {
            $accommodationImg->move($destinationPath, $profileImage);
        }
        return response()->json([
            'success' => true,
            'message' => 'Accommodation Image successfully added',
            'data' => $accommodations
        ])->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accommodation = DB::table('accommodations')
            ->join('vessels', 'vessels.id', '=', 'accommodations.vessel_id')
            ->select('accommodations.*', 'vessels.vessel_name')
            ->where('accommodations.id', $id)
            ->first();

        if ($accommodation) {
            return response()->json(['success' => true, 'data' => $accommodation], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Accommodation not found'], 404);
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
        // $accommodation = Accommodation::find($id);
        // $fares = Fare::all();
        // return response()->json([
        //     'accommodation' => $accommodation,
        //     'fares' => $fares
        // ]);
        // $accommodation = Accommodation::find($id);
        $vessels = Vessel::all();
        $accommodation = DB::table('accommodations')
            ->join('vessels', 'vessels.id', '=', 'accommodations.vessel_id')
            ->select('accommodations.*', 'vessels.vessel_name')
            ->where('accommodations.id', $id)
            ->first();

        $image_url = $accommodation->image_path ? asset('storage/accommodation-images/' . $accommodation->image_path) : null;

        return response()->json([
            'accommodation' => $accommodation,
            'vessels' => $vessels,
            'image_url' => $image_url
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
        $validateData = $this->validateDataAccommodation($request);
        $accommodation = Accommodation::findOrFail($id);
        $accommodationImg = $request->file('image_path');

        if ($accommodationImg) {
            $destinationPath = public_path('storage/accommodation-images');
            $oldImage = $accommodation->image_path;
            
            if ($oldImage !== "No Image uploaded") {
                $imagePath = $destinationPath . '/' . $oldImage;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $profileImage = date('YMdHis') . "-" . $accommodationImg->getClientOriginalName() . "." . $accommodationImg->getClientOriginalExtension();
            $validateData['image_path'] = $profileImage;
            $accommodationImg->move($destinationPath, $profileImage);
        }

        $accommodation->update($validateData);

        return response()->json([
            'success' => true,
            'message' => 'Accommodation updated successfully.',
            'data' => $accommodation
        ])->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $accommodation = Accommodation::find($id);
            if ($accommodation) {
                $accommodation->delete();
                return response()->json(['success' => true, 'message' => 'Accommodation deleted successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Accommodation not found']);
            }
        } else {
            return redirect()->route('accomodations.index')->with('error', 'Invalid request');
        }
    }

    public function validateDataAccommodation($request)
    {
        return $request->validate([
            'vessel_id' => 'required|exists:vessels,id',
            'accommodation_name' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cottage_qy' => 'required|numeric',
            
        ]);
    }
}   
    
