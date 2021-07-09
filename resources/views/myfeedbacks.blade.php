@extends('layouts.app')
@section('content')

<h5> Отзывы: </h5>

@foreach($feedbacks as $feedback)
<div class="container-fluid">
<div class="row">
<div class="col-lg-4 card text-center">
<div class="card-body">

<h6> Заголовок: {{$feedback->title}} </h6>
<h7 class="fw-normal fst-italic"> «{{$feedback->text}}» </h7><br>
<h7 style="color: #ffc107;"> Рейтинг: {{$feedback->rating}} </h7><br>
<h7> Автор: {{$feedback->user->surname}} {{$feedback->user->name}} {{$feedback->user->patronymic}}</h7>
@if($feedback->img !== null)
<img class="mt-2" src="{{Storage::url($feedback->img)}}" width="200"></img>
@endif

<form action="/myfeedback/{{$feedback->id}}">
<button type="submit" class="btn btn-outline-info mt-2">Редактировать</button>
</form>

</div>
</div>
</div>
</div>
@endforeach

@endsection