@extends('layouts.app')
@section('content')

@isset($record)
<h6>Ваш город {{$record->city->name}}?</h6>
<button type="submit" class="btn btn-outline-info">Да</button>
<button type="submit" class="btn btn-outline-info">Нет</button>
@endisset

<form action="/cities">
@isset($cities)
<p>Отсортировать города
<select name="sort">
<option value="desc">По алфавиту</option></p>
</select>
<button type="submit" class="btn btn-outline-info">Применить</button>
</form>

<h5>Выберите город:</h5>
@foreach($cities as $city)
<div class="container-fluid">
<div class="row">
<div class="col-lg-2 card text-center">
<div class="card-body">

<form action="/feedbacks/{{$city->id}}">
<button type="submit" class="btn btn-outline-info"><h6>{{$city->name}}</h6> Выбрать </button>
</form><br>

</div>
</div>
</div>
</div>
@endforeach
@endisset

@endsection
