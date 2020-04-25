@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center"><h1>Sim Slots List</h1></div>
    
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                
                <div class="row">
                    <div class="col-md-3 float-left"><h3>Phone Number</h3></div>
                    <div class="col-md-3 float-center"><h3>Provider</h3></div>   
                    <div class="col-md-3 float-right"><h3>Balance</h3></div>                   
                </div>
                <ul class="list-group">
                    @foreach ($sim_slots as $sim_slot)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="float-left col-md-3">{{ $sim_slot->phone_num }}</div>
                            <div class="float-center col-md-3">{{ $sim_slot->provider }}</div>
                            <div class="float-center col-md-3">{{ $sim_slot->balance }}</div>
                            <div class="col-md-3 float-right">
                                <a class="btn btn-info btn-small" role="button" href="{{ route('sim_slots.edit', $sim_slot->id) }}">Edit</a>
                                <a class="btn btn-danger btn-small" role="button" href="{{ route('sim_slots.delete', $sim_slot->id) }}">Delete</a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                
            </div>
        </div>
    </div>
</div>

<script>
@endsection