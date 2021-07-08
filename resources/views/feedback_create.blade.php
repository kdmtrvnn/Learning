@extends('layouts.app')
@section('content')

<div class="container py-4">
<div class="row">
<div class="col-lg-4 offset-lg-4">
<div class="form-group">
	
<form id="create" action="/feedbacks-create" method="post" enctype="multipart/form-data">
	@csrf
<label>Заголовок отзыва:</label>
<input class="form-control" type="text" name="title" value="{{old('city')}}" required autofocus />
<label>Отзыв:</label>
<textarea class="form-control" name="text" rows="3"></textarea>
<label>Рейтинг:</label>
<input class="form-control" type="number" min="1" max="5" name="rating" value="{{old('rating')}}" required autofocus />
<input class="form-file-input mt-3" type="file" name="image" accept="image/jpeg,image/png" required />
	
<select name="city" class="form-select mt-3">
<option selected>Выбрать город</option>
@foreach($cities as $city)
<option>{{$city->name}}</option>
@endforeach
</select><br>

<button type="submit" class="btn btn-outline-info">Создать отзыв</button>
<div class="spinner-border text-info" role="status">
  <span class="sr-only"></span>
</div>
</form>
<script>
document.querySelector('create').onsubmit = function () {
alert('sdsd');
}
</script>
</div>
</div>
</div>
</div>

@endsection