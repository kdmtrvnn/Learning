@extends('layouts.app')
@section('content')

<h5> Отзывы: </h5>

@isset($feedbacks)
@foreach($feedbacks as $feedback)
<div class="container-fluid">
<div class="row">
<div class="col-lg-4 card text-center">
<div class="card-body">

<h6> Заголовок: {{$feedback->title}} </h6>
<h7 class="fw-normal fst-italic"> «{{$feedback->text}}» </h7><br>
<h7 style="color: #ffc107;"> Рейтинг: {{$feedback->rating}} </h7><br>
<h7> Автор: <a href="/author/{{$feedback->id}}" class="link-info"> {{$feedback->user->surname}} {{$feedback->user->name}} {{$feedback->user->patronymic}}</h7></a>
@if($feedback->img !== null)
<img src="{{Storage::url($feedback->img)}}" width="200"></img>
@endif


</div>
</div>
</div>
</div>
@endforeach
@endisset
@endsection