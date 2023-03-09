<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = DB::table('subscriber')
            ->where('lastname', 'LIKE', '%' . $query . '%')
            ->orWhere('firstname', 'LIKE', '%' . $query . '%')
            ->orWhere('middlename', 'LIKE', '%' . $query . '%')
            ->orWhere('gender', 'LIKE', '%' . $query . '%')
            ->orWhere('address', 'LIKE', '%' . $query . '%')
            ->get();

        return view('subscribers.search-results', ['users' => $users])->render();
    }
}
