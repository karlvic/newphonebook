<?php

namespace App\Http\Controllers;

use App\Models\PostPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhoneController extends Controller
{
    public function index()
    {
        $users = DB::table('subscriber')
            ->orderByDesc('createddatetime')
            ->paginate(10);

        $providers = DB::table('subscriberdetail')
            ->orderByDesc('id')
            ->paginate(10);

        return view('index', ['users' => $users], ['providers' => $providers]);
    }

    public function saveUsers(Request $request)
    {
        /*  $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'deleted' => 'required',
        ]); */

        DB::table('subscriber')->insert([
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'lastname' => $request->input('lastname'),
            'gender' => $request->input('gender'),
            'address' => $request->input('adds'),
            'deleted' => $request->input('deleted')
        ]);


        $users = DB::table('subscriber')
            ->orderByDesc('createddatetime')
            ->paginate(10);

        return redirect('/');
    }

    public function saveProviders(Request $request)
    {


        DB::table('subscriberdetail')->insert([
            'phoneno' => $request->input('phoneNumber'),
            'provider' => $request->input('provider'),
            'deleted' => $request->input('deleted'),
            /*             'headerId' => $request->input('') */
        ]);

        return redirect('/');
    }

    
}
