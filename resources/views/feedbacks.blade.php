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
<h7> Рейтинг: {{$feedback->rating}} </h7><br>
<h7> Автор: {{$feedback->user->surname}} {{$feedback->user->name}} {{$feedback->user->patronymic}}</h7>

</div>
</div>
</div>
</div>
@endforeach

@endsection