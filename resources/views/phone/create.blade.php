@extends('base')

@section('content')
<div class="container col-md-6 offset-md-3 mt-5">
    <h1 class="text-center">Add Phone</h1>

    <form action="{{'/phones'}}" method="POST">
        {{ csrf_field() }}

        <div class="form-group mb-3">
            <label for="brand">Brand</label>
            <input type="text" name="brand" id="brand" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="phone_name">Phone Model</label>
            <input type="text" name="phone_name" id="phone_name" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="price">Price</label>
            <input type="number" step="any" name="price" id="price" class="form-control">
        </div>

        <div class="d-flex">
            <button class="btn btn-primary px-4" type="submit">Save</button>
            <a href="{{ url('/phones') }}" class="btn btn-secondary ml-5">Cancel</a>
        </div>
    </form>
</div>
@endsection
