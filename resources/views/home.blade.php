@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Command History</div>
    
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                
                <div class="row">
                    <div class="col-md-4 float-left"><h3>Name</h3></div>  
                    <div class="col-md-2 float-right"><h3>Status</h3></div> 
                    <div class="col-md-2 float-center"><h3>Start</h3></div>
                    <div class="col-md-2 float-center"><h3>End</h3></div>
                    <div class="col-md-2 float-center"><h3>Delete</h3></div>
                </div>
                <ul class="list-group">
                    @foreach ($commands as $command)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="float-left col-md-4">{{ $command->command->name }}</div>
                            <div class="float-center col-md-2">{{ $command->status }}</div>
                            <div class="float-center col-md-2">{{ $command->created_at }}</div>
                            <div class="float-center col-md-2">{{ $command->updated_at }}</div>
                            <div class="col-md-2 float-right">
                                <a class="btn btn-danger btn-small" role="button" href="{{ route('command_histories.delete', $command->id) }}">Delete</a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Statistic</div>

            <div class="card-body">
                <div class="row align-content-center mb-3">
                    <div class="col-md-4">
                        <a role="button" class="btn btn-primary" href="category">
                            Categories <span class="badge badge-light">{{ $categ_num }}</span>
                            <span class="sr-only">categories</span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a role="button" class="btn btn-primary" href="sim_slots">
                            Sim_Slots <span class="badge badge-light">{{ $sim_num }}</span>
                            <span class="sr-only">Sim Slots</span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a role="button" class="btn btn-primary" href="commands">
                            Commands <span class="badge badge-light">{{ $cmd_num }}</span>
                            <span class="sr-only">commands</span>
                        </a>
                    </div>
                </div>
                <div class="row align-content-center">
                    <div class="col-md-4"><a class="btn btn-primary" href="/category/create" role="button">Add<span class="badge badge-light">+</span></a></div>
                    <div class="col-md-4"><a class="btn btn-primary" href="/sim_slots/create" role="button">Add<span class="badge badge-light">+</span></a></div>
                    <div class="col-md-4"><a class="btn btn-primary" href="commands/create" role="button">Add<span class="badge badge-light">+</span></a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
