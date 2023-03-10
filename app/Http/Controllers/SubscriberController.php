<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriberController extends Controller
{
    public function edit($id)
{
    $user = DB ::find($id);
    return view('subscribers.edit', compact('user'));
}

    public function index(){
        return view('subscirbers.edit');
    }

}
