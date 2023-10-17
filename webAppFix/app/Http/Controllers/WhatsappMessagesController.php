<?php

namespace App\Http\Controllers;

use App\Models\WhatsappMessages;
use Illuminate\Http\Request;

class WhatsappMessagesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    function index(){
        return view('messegesList');
    }

    function read() {
        $messages = WhatsappMessages::all();
        return view('readMesseges', compact('messages'));   
    }
}
