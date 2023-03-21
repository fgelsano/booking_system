<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = DB::table('payments')
    //             ->join('profiles', 'payments.profile_id', '=', 'profiles.id')
    //             ->join('bookings', 'payments.booking_id', '=', 'bookings.id')
    //             ->join('dicounts', 'payments.discount_id', '=', 'dicounts.id')
    //             ->select('payments.id', 'profiles.id as profile_id', 'bookings.id as booking_id', 'dicounts.id as discount_id', 'payments.amount', 'payments.status')
    //             ->latest()
    //             ->get();

    //         return DataTables::of($data)
    //             ->addColumn('action', function($row){
    //                 $btn = '<a href="'.route('payments.show',$row->id).'" class="edit btn btn-primary btn-sm">View</a>';
    //                 return $btn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }

    //     return view('admin.payments.index');


    // }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Payment::latest()->get();
            // dd($data);
            return DataTables::of($data) ->addColumn('action', function($row){
                $btn = '<a href="'.route('payments.edit',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a> ';
                $btn .= '<a href="'.route('payments.destroy',$row->id).'" class="delete btn btn-danger btn-sm">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.payments.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
}
