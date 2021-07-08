<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
<header> 
<nav class="navbar navbar-expand-md navbar-light mb-4" style="background-color: #0dcaf0;">
  <div class="container-fluid">
    <a href="/myfeedbacks" class="navbar-brand" style="color: white">feedbacks</a>
    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="navbarCollapse" style="">
      <ul class="navbar-nav ms-auto mb-2 mb-md-0">
        @guest
        <a href="/login" class="nav-link active" style="color: white">Войти</a>
        <a href="/register" class="nav-link active" style="color: white">Зарегистрироваться</a>
        @endguest
        @auth
        <a href="/cities" class="nav-link active" style="color: white">Выбрать город</a>
        <a href="/feedbacks-create" class="nav-link active" style="color: white">Создать отзыв</a>
        <span class="nav-link active me-2" style="color: #ffffff;"><b>Привет, {{request()->user()->name}} </b></span>
     </ul>
  <form method="post" action="/logout">
    @csrf
  <button type="submit" class="btn btn-outline-light">Выйти</button>
  </form>
  @endauth
    </div>
  </div>
</nav>
</header>
    @yield('content')   
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>