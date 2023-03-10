<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function index()
    {
        $users = DB::table('subscriber')
            ->orderByDesc('createddatetime')
            ->paginate(10);

        $providers = DB::table('subscriberdetail')
            ->orderByDesc('id')
            ->paginate(10);

        return view('index', ['users' => $users], ['providers' => $providers])->with('status', "Added!");
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = DB::table('subscriber')
            ->orderByDesc('id')
            ->where('lastname', 'LIKE', '%' . $query . '%')
            ->orWhere('firstname', 'LIKE', '%' . $query . '%')
            ->orWhere('middlename', 'LIKE', '%' . $query . '%')
            ->orWhere('gender', 'LIKE', '%' . $query . '%')
            ->orWhere('address', 'LIKE', '%' . $query . '%')
            ->paginate(10);

        return view('subscribers.search-results', ['users' => $users])->render();
     
    }
}
