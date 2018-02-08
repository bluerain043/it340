<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return \redirect()->guest('login');
        //var_dump(\Auth::user());die;
        //$allRooms = Room::getAllRooms('room_name');
        //return view('dashboard.index', compact('allRooms'));
        echo phpinfo();
        return view('home');
    }
}
