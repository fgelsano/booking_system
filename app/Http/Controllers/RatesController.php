<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use App\Models\Fare;
use Illuminate\Http\Request;



class RatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Fare::latest()->get();
            return DataTables::of($data)->addColumn('action', function ($fare) {
                $editUrl = route('rates.edit', $fare->id);
                $deleteUrl = route('rates.destroy', $fare->id);

                $editButton = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm edit" data-toggle="modal" data-target="#editModal" data-id="' . $fare->id . '">Edit</a>';
                $deleteButton = '<button type="button" class="btn btn-danger btn-sm delete" data-url="' . $deleteUrl . '">Delete</button>';

                return $editButton . ' ' . $deleteButton;
            })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.settings.rates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.settings.rates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fare_name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $rates = Fare::create([
            'fare_name' => $request->fare_name,
            'price' => $request->price,
        ]);

        if ($rates) {
            return response()->json(['success' => 'Rates added successfully.']);
        } else {
            return response()->json(['error' => 'Failed to add rates.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fare = Fare::find($id);
        return response()->json($fare);
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
        $fare = Fare::find($id);

        if ($fare) {
            $request->validate([
                'fare_names' => 'required|string|max:255',
                'prices' => 'required|numeric',
            ]);

            $fare->fare_name = $request->fare_names;
            $fare->price = $request->prices;
            $fare->save();
            return response()->json(['success' => 'Rates updated successfully.']);
        } else {
            return response()->json(['error' => 'Rates not found.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $fare = Fare::findOrFail($id);
        $fare->delete();
        return response()->json(['success' => 'Rates deleted successfully.']);
    }
}
