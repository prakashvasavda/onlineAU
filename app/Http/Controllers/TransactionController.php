<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use DataTables;


class TransactionController extends Controller{

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

        return view('transactions.index');
    }
 
    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        //
    }
}
