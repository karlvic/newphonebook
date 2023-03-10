<?php

namespace App\Http\Controllers;

use App\Models\PostPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhoneController extends Controller {
    public function index() {
        $users = DB::table( 'subscriber' )
        ->orderByRaw( 'COALESCE(updateddatetime, createddatetime) DESC' )
        ->paginate( 10 );

        $providers = DB::table( 'subscriberdetail' )
        ->orderByDesc( 'id' )
        ->paginate( 10 );

        return view( 'subscribers.index', [ 'users' => $users ], [ 'providers' => $providers ] );
    }

    public function saveUsers( Request $request ) {
        DB::table( 'subscriber' )->insert( [
            'firstname' => $request->input( 'firstname' ),
            'middlename' => $request->input( 'middlename' ),
            'lastname' => $request->input( 'lastname' ),
            'gender' => $request->input( 'gender' ),
            'address' => $request->input( 'adds' ),
            'deleted' => $request->input( 'deleted' )
        ] );

        $users = DB::table( 'subscriber' )
        ->orderByDesc( 'createddatetime' )
        ->paginate( 10 );

        return redirect( '/' );
    }

    public function update( Request $request ) {

    }

    public function saveProviders( Request $request ) {
        $provider = $request->input( 'provider' );
        $phoneNumber = $request->input( 'phoneNumber' );
        $headerId = $request->input( 'headerId' );

        DB::table( 'subscriberdetail' )->insert( [
            'headerId' => $headerId,
            'provider' => $provider,
            'phoneno' => $phoneNumber,
        ] );

        return response()->json( [ 'success' => true ] );
        return redirect( '/' );
    }

}
