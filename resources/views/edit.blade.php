@extends('layouts.app')
@section('content')

<div class="container py-4">
<div class="row">
<div class="col-lg-4 offset-lg-4">
<div class="form-group">
	
<h4>Редактируйте свой отзыв</h4>
<form action="/edit" method="post" enctype="multipart/form-data">
	@csrf
<label>Заголовок отзыва:</label>
<input class="form-control" type="text" name="title" value="{{$feedback->title}}" required autofocus />
<label>Отзыв:</label>
<textarea class="form-control" name="text" rows="3">{{$feedback->text}}</textarea>
<label>Рейтинг:</label>
<input class="form-control" type="number" min="1" max="5" name="rating" value="{{$feedback->rating}}" required autofocus />
<input class="form-file-input mt-3" type="file" name="image" accept="image/jpeg,image/png" />
	
<select name="city" class="form-select mt-3">
<option  selected>{{$feedback->city->name}}</option>
@foreach($cities as $city)
<option>{{$city->name}}</option>
@endforeach
</select><br>

<button type="submit" class="btn btn-outline-info">Редактировать отзыв</button>
</form>

</div>
</div>
</div>
</div>

@endsection