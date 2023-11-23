<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use DataTables;

class TransactionsController extends Controller{
    
    public function index(Request $request){
        $data['menu'] = "transactions";
        if ($request->ajax()) {
           return DataTables::of(Payment::get())
            ->addColumn('action', function ($item) {
                // Add custom actions here
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.transactions.index', $data);
    }

   
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
