<html>
<title>@yield('title', 'Api de juegos')</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('bootstrap/js/bootstrap.min.js') }}" rel="stylesheet">
<link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
<script>
$(document).ready(function(){
  $(".alert").click(function(){
    $(".alert").remove();
  });
});
</script>
</head>
<body>
<div class="container">

@yield('header')