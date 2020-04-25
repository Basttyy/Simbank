@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center"><h1>Category List</h1></div>
    
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                
                <div class="ml-3 row">
                    <div class="col-md-6 float-left"><h3>Name</h3></div>
                    <div class="col-md-6 float-right"><h3>Description</h3></div>
                </div>
                <ul class="list-group">
                    @foreach ($categories as $category)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="float-left col-md-2">{{ $category->name }}</div>
                            <div class="float-center col-md-7">{{ $category->description }}</div>
                            <div class="col-md-3 float-right">
                                <a class="btn btn-info btn-small" role="button" href="{{ route('category.edit', $category->id) }}">Edit</a>
                                <a class="btn btn-danger btn-small" role="button" href="{{ route('categories.delete', $category->id) }}">Delete</a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                
            </div>
        </div>
    </div>
</div>
@endsection