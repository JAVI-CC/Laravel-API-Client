<?php

namespace App\Http\Controllers;

use App\Juego;
use Illuminate\Http\Request;
use Cookie;

class AuthController extends Controller
{
    protected $juego;

    public function __construct(Juego $juego)
    {
        $this->juego = $juego;
    }

    public function register(Request $request){
        $token = $this->juego->register($request);
        $name = $request->input('name');
        return view('home', compact('name'));
    }

    public function login(Request $request){

        $error = $this->juego->login($request);

        if (isset($error->token)) {
            $token = $error->token;
            return view('home', compact('token'));
        } else {
            $values = $request->all();
            return view('auth.login', compact('error', 'values'));
        }

    }

    public function userinfo(){
        $error = $this->juego->userinfo();
        return dd($error);
    }

    public function logout(){
        $this->juego->logout();
        $juegos = $this->juego->getall();
        $juegos = $this->juego->paginate($juegos, 12);
        $logout = true;
        return view('index', compact('juegos', 'logout'));
    }

}
