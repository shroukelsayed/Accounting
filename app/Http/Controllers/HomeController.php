<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Session;


class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // var_dump( isset(Auth::user()->id) and (Auth::user()->role == 1 || Auth::user()->role == 2  ));die;
        if( isset(Auth::user()->id) and (Auth::user()->role == 1 || Auth::user()->role == 2  )){
            
            return view('home');

        }elseif(isset(Auth::user()->id) and (Auth::user()->role == 3)){

           
        }elseif(isset(Auth::user()->id) and (Auth::user()->role == 4)){

            // if(isset(Auth::user()->id) and (Auth::user()->approved == 1 )){
            //     return \Redirect::to('/home');
            // }else{
            //     \Session::flush();
            //     return view('approved');
            // }
       }else{
                
            return view('welcome');
        }

    }

   


}
