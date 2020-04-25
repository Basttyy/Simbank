@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-12 col-sm-10">
        <div class="card">
            <div class="card-header text-center"><h1>Commands List</h1></div>
    
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                
                <div class="row">
                    <div class="col-md-3 float-left"><h3>Name</h3></div>
                    <div class="col-md-4 float-center"><h3>Description</h3></div>   
                    <div class="col-md-2 float-right"><h3>Status</h3></div>             
                </div>
                <ul class="list-group">
                    @foreach ($commands as $command)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="float-left col-md-3">{{ $command->name }}</div>
                            <div class="float-center col-md-4">{{ $command->description }}</div>
                            <div class="float-center col-md-2">{{ $command->status }}</div>
                            <div class="col-md-3 float-right">
                                <a class="btn btn-info btn-small" role="button" href={{ route('commands.edit', $command->id) }}>Edit</a>
                                <a class="btn btn-danger btn-small" role="button" href="{{ route('commands.delete', $command->id) }}">Delete</a>
                            <button <?php if($command->status != "enabled") echo "disabled"; ?> class="btn btn-danger btn-small" onclick="runCommand('{{ $command->value }}', '{{ $command->id }}' '{{ Auth::user()->id }}')">Run</button>
                                {{-- <button class="btn btn-danger btn-small" onclick="doJamb()">Run</button> --}}
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
function sendCommand(){
    console.log("sending command via socket...")
    var cmd = $('#comVal').val().replace("code", $('#inputCode').val())
    var data = {value: cmd, id: $('#comId').val(), user_id: $('#userId').val()}
    console.log(data);
    socket.emit('command', data)
}

// function get_action(form, url) {
//     form.action = url
// }

function runCommand(commandVal, id) {
    const { value: formValues } = Swal.queue([{
        title: 'Run Command',
        html:
            '<form class="was-validated" action="">' +
                '<div class="form-group row">' +
                    '<label class="col-sm-12 col-form-label">Enter the codes in the inputs below...</label>' +
                '</div>' +
                '<div class="form-group row">' +
                    '<label for="commandVal" class="col-sm-4 col-form-label">Command</label>' +
                    '<div class="col-sm-8">' +
                        '<input type="text" name="commandVal" readonly class="form-control-plaintext" id="comVal">' +
                    '</div>' +
                '</div>' +
                '<div class="form-group row">' +
                    '<label for="inputCode" class="col-sm-4 col-form-label">Code</label>' +
                    '<div class="col-sm-8">' +
                    '<input type="number" name="code" class="form-control is-valid" id="inputCode" placeholder="Code">' +
                    '</div>' +
                '</div>' +
                '<input type="hidden" name="comId" id="comId">' +
                '<input type="hidden" name="userId" id="userId">' +
                '<button type="button" onclick="sendCommand();" class="btn btn-primary">Submit</button>' +
            '</form>',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
    }])

    document.getElementById("comVal").value = commandVal
    document.getElementById("comId").value = id
}
</script>
@endsection