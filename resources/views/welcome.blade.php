@extends('layouts.app')
@section('content')

@isset($record)
<div class="container py-4">
<div class="row">
<div class="col-lg-4 offset-lg-4 card text-center">
<div class="card-body">

<h6>Ваш город {{$record->city->name}}?</h6>
<form action="/city" class="d-inline-block">
<button type="submit" class="btn btn-outline-info">Да</button>
</form>
<form action="/back" class="d-inline-block">
<button type="submit" class="btn btn-outline-info">Нет</button>
</form>

</div>
</div>
</div>
</div>
@endisset

@endsection