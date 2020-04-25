@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-1">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center"><h1>Command History</h1></div>
    
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                
                <div class="row">
                    <div class="col-md-3 float-left"><h3>Name</h3></div>  
                    <div class="col-md-3 float-right"><h3>Status</h3></div> 
                    <div class="col-md-3 float-center"><h3>Start</h3></div>
                    <div class="col-md-3 float-center"><h3>End</h3></div>                  
                </div>
                <ul class="list-group">
                    @foreach ($command_histories as $command)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="float-left col-md-2">{{ $command->command->name }}</div>
                            <div class="float-center col-md-2">{{ $command->status }}</div>
                            <div class="float-center col-md-2">{{ $command->created_at }}</div>
                            <div class="float-center col-md-2">{{ $command->updated_at }}</div>
                            <div class="col-md-3 float-right">
                                <a class="btn btn-info btn-small" role="button" href="commands/{{ $command->id }}/edit">Edit</a>
                                <a class="btn btn-danger btn-small" role="button" href="{{ route('commands.delete', $command->id) }}">Delete</a>
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