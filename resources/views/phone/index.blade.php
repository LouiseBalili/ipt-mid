@extends('base')

@section('content')
    @if(session('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success me-2" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </svg>
        <div>
            {{ session('success') }}
        </div>
    </div>
    @endif
    <div class="d-flex align-items-center justify-content-between mt-5">
        <h2 class="mb-0">List of Phones</h2>
        <a href="/phones/create" class="btn btn-primary btn-sm px-4">Add Phone</a>
    </div>
    <hr class="mt-2 mb-0">
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Brand</th>
            <th>Phone Model</th>
            <th>Price</th>
            <th class="text-center">Action</th>
        </thead>
        <tbody>
            @foreach($phones as $phone)
            <tr>
                <td>{{ $phone->id }}</td>
                <td>{{ $phone->brand }}</td>
                <td>{{ $phone->phone_name }}</td>
                <td>P{{ $phone->price }}</td>
                <td>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ url('/phones/edit/'. $phone->id) }}" class="btn btn-sm btn-primary text-white me-2">Edit</a>
                        <form action="{{ url('/phones/delete/'.$phone->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        <button type="submit" onclick="return confirm('Do you want to delete this phone?');" class="btn btn-sm btn-danger text-white">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
