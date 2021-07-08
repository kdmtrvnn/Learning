@extends('layouts.app')
@section('content')

<form action="/cities" class="d-inline-block">
<p>Отсортировать города
<select name="sort" class="form-select">
<option value="desc">По алфавиту</option></p>
</select>
<button type="submit" class="btn btn-outline-info">Применить</button>
</form>

<h5>Выберите город:</h5>
<div class="container-fluid mx-auto my-auto p-4">
  <div class="row"> 
	@foreach($cities as $city)
 	 <div class="card col-lg-3 card text-center">
 	   <div class="card-body">

<form action="/feedbacks/{{$city->id}}">
<button type="submit" class="btn btn-outline-info"><h6>{{$city->name}}</h6> Выбрать </button>
</form><br>

</div>
</div>
@endforeach
</div>
</div>

@endsection
