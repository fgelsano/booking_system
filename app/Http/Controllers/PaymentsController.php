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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $payments = Payment::select('payments.id', 'profiles.firstname as profile_id', 'bookings.id as booking_id.id', 'dicounts.discount_type as discount_id', 'schedules.origin as booking_id.origin', 'schedules.destination as booking_id.destination', 'payments.amount', 'payments.status')
                ->join('profiles', 'profiles.id', '=', 'payments.profile_id')
                ->join('bookings', 'bookings.id', '=', 'payments.booking_id')
                ->join('dicounts', 'dicounts.id', '=', 'payments.discount_id')
                ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
                ->get();

            return DataTables::of($payments)->addColumn('action', function ($row) {
                $btn = '<a href="' . route('payments.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a> ';
                $btn .= '<a href="' . route('payments.destroy', $row->id) . '" class="delete btn btn-danger btn-sm">Delete</a>';
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
        $request->validate([
            'profile_id' => 'required',
            'booking_id' => 'required',
            'discount_id' => 'required',
            'amount' => 'required',
            'status' => 'required',
        ]);

        Payment::create([
            'profile_id' => $request->input('profile_id'),
            'booking_id' => $request->input('booking_id'),
            'discount_id' => $request->input('discount_id'),
            'amount' => $request->input('amount'),
            'status' => $request->input('status'),
        ]);

        $payments = Payment::select('payments.id', 'profiles.firstname as profile_id', 'bookings.id as booking_id', 'discounts.discount_type as discount_id', 'schedules.origin as booking_origin', 'schedules.destination as booking_destination', 'payments.amount', 'payments.status')
            ->join('profiles', 'profiles.id', '=', 'payments.profile_id')
            ->join('bookings', 'bookings.id', '=', 'payments.booking_id')
            ->join('dicounts', 'dicounts.id', '=', 'payments.discount_id')
            ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
            ->get();

        return DataTables::of($payments)->addColumn('action', function ($row) {
            $btn = '<a href="' . route('payments.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a> ';
            $btn .= '<a href="' . route('payments.destroy', $row->id) . '" class="delete btn btn-danger btn-sm">Delete</a>';
            return $btn;
        })
            ->rawColumns(['action'])
            ->make(true);
        $request->validate([
            'profile_id' => 'required',
            'booking_id' => 'required',
            'discount_id' => 'required',
            'amount' => 'required',
            'status' => 'required',
        ]);

        Payment::create([
            'profile_id' => $request->input('profile_id'),
            'booking_id' => $request->input('booking_id'),
            'discount_id' => $request->input('discount_id'),
            'amount' => $request->input('amount'),
            'status' => $request->input('status'),
        ]);

        $payments = Payment::select('payments.id', 'profiles.firstname as profile_id', 'bookings.id as booking_id', 'discounts.discount_type as discount_id', 'schedules.origin as booking_origin', 'schedules.destination as booking_destination', 'payments.amount', 'payments.status')
            ->join('profiles', 'profiles.id', '=', 'payments.profile_id')
            ->join('bookings', 'bookings.id', '=', 'payments.booking_id')
            ->join('dicounts', 'dicounts.id', '=', 'payments.discount_id')
            ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
            ->get();

        return DataTables::of($payments)->addColumn('action', function ($row) {
            $btn = '<a href="' . route('payments.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a> ';
            $btn .= '<a href="' . route('payments.destroy', $row->id) . '" class="delete btn btn-danger btn-sm">Delete</a>';
            return $btn;
        })
            ->rawColumns(['action'])
            ->make(true);
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
