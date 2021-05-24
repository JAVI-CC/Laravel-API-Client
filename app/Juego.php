<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


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
        $response = $this->client->request('POST', '/api/juegos', ['form_params' => ['nombre' => $request->input('nombre'), 'desarrolladora' => $request->input('desarrolladora'), 'fecha' => $request->input('fecha'), 'descripcion' => $request->input('descripcion'),]]);
        return json_decode($response->getBody()->getContents());
    }

    public function apiupdate($request, $slug)
    {
        $response = $this->client->request('POST', '/api/juegos/' . $slug, ['form_params' => ['nombre' => $request->input('nombre'), 'desarrolladora' => $request->input('desarrolladora'), 'fecha' => $request->input('fecha'), 'descripcion' => $request->input('descripcion'),]]);
        return json_decode($response->getBody()->getContents());
    }

    public function apidelete($slug)
    {
        $response = $this->client->request('GET', '/api/juegos/delete/' . $slug);
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
