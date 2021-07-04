@extends('layouts.app')
@section('content')

<div class="container py-4">
        <div class="row">
        <div class="col-lg-4 offset-lg-4">
        <form>
            @csrf

            <div>
                <label for="code" class="text-secondary">Code</label>

                <input id="code" class="form-control @error('code') is-invalid @enderror" type="code" name="code" value="{{old('code')}}" required autofocus />
            </div>
            <button type="submit" class="btn btn-outline-info">
                </button>
            </div>
        </form>
        </div>
        </div>
        </div>

@endsection