<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

<p>Laravel 8 and PHP 8 application web responsive that contains interface web, user registers and the application connected to a Laravel API <a href="https://laravelapijuegos.herokuapp.com/api/juegos" target="_blank"> https://laravelapijuegos.herokuapp.com</a></p>

<p>Project Laravel Api Server: <a href="https://github.com/JAVI-CC/Laravel-API-Server" target="_blank">https://github.com/JAVI-CC/Laravel-API-Server</a></p>

<h2>Setup</h2>
<pre><code>$ composer install && php artisan key:generate</code></pre>

<h2>.env</h2>
<p><strong>API_SERVER= </strong>https://laravelapijuegos.herokuapp.com</p>

<h2>Demo</h2>
<a href="http://laravelclienteapi.herokuapp.com" target="_blank">http://laravelclienteapi.herokuapp.com</a><br>
<span>User: admin@email.com</span><br>
<span>Password: 12345678</span>

<hr>

<h3>Show get all registries API SERVER:</h3>
<p align="center"><img src="/public/capturas/captura_1.png"></p>
<p align="center"><img src="/public/capturas/captura_2.png"></p>
<p align="center"><img src="/public/capturas/captura_3.png"></p>

<h3>Create or update registrer sending it to the API SERVER:</h3>
<p align="center"><img src="/public/capturas/captura_4.png"></p>

<h3>Application web responsive</h3>
<p align="center"><img src="/public/capturas/captura_5.png"></p>

<h2>Deploy to Docker <g-emoji class="g-emoji" alias="whale" fallback-src="https://github.githubassets.com/images/icons/emoji/unicode/1f433.png">🐳</g-emoji></h2>

<h4>Containers:</h4>
<ul>
<li><span>nginx:alpine</span> - <code>:8000->80/tcp</code></li>
<li><span>php:8.0.6-fpm</span> - <code>:9000</code></li>
</ul>

<h4>Containers structure:</h4>
<div class="highlight highlight-source-shell"><pre>├── laravel-api-client-app
├── laravel-api-client-web</pre></div>

<h4>Setup:</h4>
<pre>
<code>$ git clone https://github.com/JAVI-CC/Laravel-API-Client.git
$ cd Laravel-API-Client
$ cp .env.example .env
$ docker-compose up -d
$ docker-compose exec app composer install
$ docker-compose exec app php artisan key:generate</code>
</pre>

<span>Once you have the containers deployed, you can access the API at </span> <a href="http://localhost:8000" target="_blank">http://localhost:8000</a>
