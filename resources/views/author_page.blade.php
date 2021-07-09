@extends('layouts.app')
@section('content')

<h5> Контактные данные: </h5>
<h7> Email: {{$feedback->user->email}} </h7><br>
<h7> Номер телефона: {{$feedback->user->phone}} </h7><br>

<br><h5> Отзывы автора: </h5>

@foreach($feedback->user->feedbacks as $feedback)
<div class="container-fluid">
<div class="row">
<div class="col-lg-4 card text-center">
<div class="card-body">

<h6> Заголовок: {{$feedback->title}} </h6>
<h7 class="fw-normal fst-italic"> «{{$feedback->text}}» </h7><br>
<h7 style="color: #ffc107;"> Рейтинг: {{$feedback->rating}} </h7><br>
<h7> Город: <b> {{$feedback->city->name}} </b></h7><br>
@if($feedback->img !== null)
<img src="{{Storage::url($feedback->img)}}" width="200"></img>
@endif

</div>
</div>
</div>
</div>
@endforeach

@endsection