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

    public function add_form()
    {
      $generos = $this->juego->getallgeneros();
      return view('add', compact('generos'));
    }

    public function add(Request $request)
    {
        $error = $this->juego->apiadd($request);
        $generos = $this->juego->getallgeneros();
        if (isset($error->slug)) {
            $juegos = $this->getAll();
            $success = 'Se ha insertado correctamente el juego: ' . $error->nombre;
            return view('index', compact('juegos', 'success'));
        } else {
            $values = $request->all();
            return view('add', compact('error', 'values', 'generos'));
        }
    }

    public function show($slug)
    {
        $juego = $this->juego->getslug($slug);
        $generos = $this->juego->getallgeneros();

        $juegos = $this->getAll();
        if(isset($juego->error)) {
          $error = $juego->error;
          return view('index', compact('juegos', 'error'));
        } else { 
          return view('edit', compact('juego', 'generos'));
        }
    }

    public function showdesarrolladora($slug)
    {
        $juegos = $this->juego->getslugdesarrolladora($slug);
        if(isset($juegos->error)) {
          $error = $juegos->error;
          $juegos = $this->getAll();
          return view('index', compact('juegos', 'error'));
        } else if($juegos == null) {
          $error = 'No se ha encontrado ningún juego';
          return view('not_found', compact('error'));
        } else { 
          $juegos = $this->juego->paginate($juegos, 100);
          return view('index', compact('juegos', 'slug'));
        }
    }

    public function showgenero($slug)
    {
        $juegos = $this->juego->getsluggenero($slug);
        if(isset($juegos->error)) {
          $error = $juegos->error;
          $juegos = $this->getAll();
          return view('index', compact('juegos', 'error'));
        } else if($juegos == null) {
          $error = 'No se ha encontrado ningún juego';
          return view('not_found', compact('error'));
        } else { 
          $juegos = $this->juego->paginate($juegos, 100);
          return view('index', compact('juegos', 'slug'));
        }
    }

    public function update(Request $request)
    {
        $error = $this->juego->apiupdate($request);
        $juegos = $this->getAll();
        $generos = $this->juego->getallgeneros();
        if (isset($error->slug)) {
            $success = 'Se ha modificado correctamente el juego: ' . $error->nombre;
            return view('index', compact('juegos', 'success'));
        } else if(isset($error->error)) {
            $error = $error->error;
            return view('index', compact('juegos', 'error'));
        } else {
            $values = $request->all();
            $slug = $request->input('slug');
            return view('edit', compact('error', 'values', 'generos', 'slug'));
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
