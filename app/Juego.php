<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File; 


class Juego extends Model
{
    protected $client;

    protected $headers = [
        'Content-Type' => 'application/json',
        'api-key' => '$2y$10$f01jcbsMhFuNif8yHAotQuGr4OaqwfXi6g96Y4DHVIkw3HjQgMwMu',
    ];

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://laravelapijuegos.herokuapp.com',
            'headers' => $this->headers,
            'defaults' => [
                'exceptions' => false
            ]
        ]);
    }

    protected function upload_image($imagen){
        if($imagen == null) return null;
        
        $filename = "background." .$imagen->getClientOriginalExtension();
        $imagen->move(storage_path('/'), $filename);
        return $filename;
    }

    protected function delete_image(){
        File::delete(File::glob(storage_path('/background.*')));
    }

    public function apiupdate($request) {

        if($request->exists('imagen') == true) {
            $update = $this->apiupdatewithimage($request);
            return $update;
        } else { 
            $update = $this->apiupdatewithoutimage($request);
            return $update;
        }
       
    }

    public function getall()
    {
        $response = $this->client->request('GET', '/api/juegos');
        return json_decode($response->getBody()->getContents());
    }

    public function getslug($slug)
    {
        $response = $this->client->request('GET', '/api/juegos/' . $slug);
        return json_decode($response->getBody()->getContents());
    }

    public function apiadd($request)
    {
        $filename = $this->upload_image($request->file('imagen'));

        $response = $this->client->request('POST', '/api/juegos', [ 'multipart' => [
            [ 
                'name' => 'nombre', 
                'contents' => $request->input('nombre')
            ],
            [ 
                'name' => 'desarrolladora', 
                'contents' => $request->input('desarrolladora')
            ],
            [ 
                'name' => 'fecha', 
                'contents' => $request->input('fecha')
            ],
            [ 
                'name' => 'descripcion', 
                'contents' => $request->input('descripcion')
            ],
            [ 
                'name' => 'imagen', 
                'contents' =>  ($filename == null) ? '' : fopen(storage_path('/'.$filename), 'r')
            ],
            ]
        ]
    );

        $this->delete_image();
        return json_decode($response->getBody()->getContents());
    }

    public function apiupdatewithoutimage($request)
    {
        $response = $this->client->request('PUT', '/api/juegos/edit', ['form_params' => ['nombre' => $request->input('nombre'), 'desarrolladora' => $request->input('desarrolladora'), 'fecha' => $request->input('fecha'), 'descripcion' => $request->input('descripcion'), 'slug' => $request->input('slug')]]);
        return json_decode($response->getBody()->getContents());
    }

    public function apiupdatewithimage($request)
    {
        $filename = $this->upload_image($request->file('imagen'));

        $response = $this->client->request('POST', '/api/juegos/edit' , [
            
            'multipart' => [
            [ 
                'name' => 'nombre', 
                'contents' => $request->input('nombre')
            ],
            [ 
                'name' => 'desarrolladora', 
                'contents' => $request->input('desarrolladora')
            ],
            [ 
                'name' => 'fecha', 
                'contents' => $request->input('fecha')
            ],
            [ 
                'name' => 'descripcion', 
                'contents' => $request->input('descripcion')
            ],
            [ 
                'name' => 'imagen', 
                'contents' => ($filename == null) ? '' : fopen(storage_path('/'.$filename), 'r')
            ],
            [ 
                'name' => 'slug', 
                'contents' => $request->input('slug')
            ],
            ]
        ]
                
            );  

        $this->delete_image();
        return json_decode($response->getBody()->getContents());
    }

    public function apidelete($slug)
    {
        $response = $this->client->request('DELETE', '/api/juegos/delete/' . $slug);
        return json_decode($response->getBody()->getContents());
    }

    public function apisearch($request)
    {
        if ($request->order == 0 || $request->order == 1) {
            $filter = '';
            $order = '';
        } else if ($request->order == 2) {
            $filter = 'nombre';
            $order = 'ASC';
        } else if ($request->order == 3) {
            $filter = 'nombre';
            $order = 'DESC';
        } else if ($request->order == 4) {
            $filter = 'fecha';
            $order = 'ASC';
        } else if ($request->order == 5) {
            $filter = 'fecha';
            $order = 'DESC';
        }

        $response = $this->client->request('POST', '/api/juegos/filter/search', ['form_params' => ['search' => $request->input('search'), 'filter' => $filter, 'order' => $order]]);
        return json_decode($response->getBody()->getContents());
    }

    public function paginate($items, $perPage, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
