<?php

namespace App\Http\Controllers;

use App\FrontUser;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        if (empty($data['search'])) {
            return redirect()->route('home');
        }
        if ($data['type'] == "family") {
            $search = FrontUser::where('role', 'family')->whereRaw("family_address LIKE ?", ['%' . $data['search'] . '%'])->get();
        } else {
            $search = FrontUser::where('role', '!=', 'family')->whereRaw("area LIKE ?", ['%' . $data['search'] . '%'])->get();
        }
        $type = $data['type'];
        return view('user.search', compact('search', 'type'));
    }
}
