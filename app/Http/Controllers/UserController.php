<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subscriber;

class UserController extends Controller {
    public function update( Request $request ) {
        $id = $request->id;
        $column = $request->column;
        $value = $request->value;

        DB::table( 'subscriber' )
        ->where( 'id', $id )
        ->update( [
            $column => $value,
            'updateddatetime' => DB::raw( 'CURRENT_TIMESTAMP' )
        ] );

        return redirect( '/' );
    }

    

}
