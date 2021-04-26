<?php

namespace App\Http\Controllers;

use App\Juego;
use Illuminate\Http\Request;

class JuegoController extends Controller
{
    protected $juego;

    public function __construct(Juego $juego)
    {
        $this->juego = $juego;
    }

    public function getAll() {
        $juegos = $this->juego->getall();
        $juegos = $this->juego->paginate($juegos, 12);
        return $juegos;
    }

    public function index()
    {
        $juegos = $this->getAll();
        return view('index', compact('juegos'));
    }

    public function add(Request $request)
    {
        $error = $this->juego->apiadd($request);
        if (isset($error->success)) {
            $juegos = $this->getAll();
            $success = $error->success;
            return view('index', compact('juegos', 'success'));
        } else {
            $values = $request->all();
            return view('add', compact('error', 'values'));
        }
    }

    public function show($slug)
    {
        $juego = $this->juego->getslug($slug);
        $juegos = $this->getAll();
        if(isset($juego->error)) {
          $error = $juego->error;
          return view('index', compact('juegos', 'error'));
        } else { 
          return view('edit', compact('juego'));
        }
    }

    public function update(Request $request)
    {
        $error = $this->juego->apiupdate($request);
        $juegos = $this->getAll();
        if (isset($error->success)) {
            $success = $error->success;
            return view('index', compact('juegos', 'success'));
        } else if(isset($error->error)) {
            $error = $error->error;
            return view('index', compact('juegos', 'error'));
        } else {
            $values = $request->all();
            return view('edit', compact('error', 'values', 'slug'));
        }
    }

    public function delete($slug)
    {
        $juego = $this->juego->apidelete($slug);
        $juegos = $this->getAll();
        if (isset($juego->success)) {
            $success = $juego->success;
            return view('index', compact('juegos', 'success'));
        } else if(isset($juego->error)) {
            $error = $juego->error;
            return view('index', compact('juegos', 'error'));
        }
    }

    public function search(Request $request){

        $juegos = $this->juego->apisearch($request);
        if(isset($juegos->error)) {
          $error = $juegos->error;    
          return view('not_found', compact('error'));
        } else {
          $juegos = $this->juego->paginate($juegos, 100);
          $search = $request->search;
          $order = $request->order;
          return view('index', compact('juegos', 'search', 'order'));
        }

    }
}
