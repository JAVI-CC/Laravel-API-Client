<?php

namespace App;

use Cookie;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File; 


class Juego extends Model
{
    protected $client;

    protected $headers = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ];

    public $client_login;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('API_SERVER'),
            'headers' => $this->headers,
            'defaults' => [
                'exceptions' => false
            ]
        ]);
    }

    public function getCookieToken(){
        return Cookie::get('token');
    }

    public function setCookieToken($token){
        Cookie::queue('token', $token, 36000);
    }

    public function destroyCookiToken(){
        Cookie::queue(Cookie::forget('token'));
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

    public function getslugdesarrolladora($slug)
    {
        $response = $this->client->request('GET', '/api/juegos/desarrolladoras/' . $slug);
        return json_decode($response->getBody()->getContents());
    }

    public function apiadd($request)
    {
        $filename = $this->upload_image($request->file('imagen'));
        $token = $this->getCookieToken();
        $response = $this->client->request('POST', '/api/juegos', [ 'headers' => ['Authorization' => $token], 'multipart' => [
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
        $token = $this->getCookieToken();
        $response = $this->client->request('PUT', '/api/juegos/edit', ['headers' => ['Authorization' => $token], 'form_params' => ['nombre' => $request->input('nombre'), 'desarrolladora' => $request->input('desarrolladora'), 'fecha' => $request->input('fecha'), 'descripcion' => $request->input('descripcion'), 'slug' => $request->input('slug')]]);
        return json_decode($response->getBody()->getContents());
    }

    public function apiupdatewithimage($request)
    {
        $filename = $this->upload_image($request->file('imagen'));
        $token = $this->getCookieToken();
        $response = $this->client->request('POST', '/api/juegos/edit', [ 'headers' => ['Authorization' => $token],            
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
        $token = $this->getCookieToken();
        $response = $this->client->request('DELETE', '/api/juegos/delete/' . $slug, ['headers' => ['Authorization' => $token]]);
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


    /*****************************************Auth***********************************************/
    public function register($request)
    {
        $response = $this->client->request('POST', '/api/auth/register', ['form_params' => ['name' => $request->input('name'), 'email' => $request->input('email'), 'password' => $request->input('password'), 'password_confirmation' => $request->input('password_confirmation')]]);
        $res = json_decode($response->getBody()->getContents());
        //$head = Arr::add($this->headers, 'Authorization', $token);
    }

    public function login($request)
    {
        $response = $this->client->request('POST', '/api/auth/login', ['form_params' => ['email' => $request->input('email'), 'password' => $request->input('password')]]);
        $res = json_decode($response->getBody()->getContents());
        
        if(isset($res->token)) {
          $this->setCookieToken($res->token);
          //Cookie::queue('token', $res->token, 36000);
        }

        return $res;
    }

    public function userinfo()
    {
        $token = $this->getCookieToken();
        $response = $this->client->request('GET', '/api/auth/userinfo', ['headers' => ['Authorization' => $token]]);
        return json_decode($response->getBody()->getContents());
    }

    public function logout()
    {
        $token = $this->getCookieToken();
        $this->client->request('POST', '/api/auth/logout', ['headers' => ['Authorization' => $token]]);
        $this->destroyCookiToken();
    }
}
