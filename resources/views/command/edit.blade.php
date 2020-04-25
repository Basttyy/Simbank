@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header">{{ __('Update Command') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('commands.update', $command->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $command->name }}" name="name" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                    <div class="col-md-6">
                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" value="{{ $command->description }}" name="description" required autocomplete="description" autofocus>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Value') }}</label>

                    <div class="col-md-6">
                        <input id="value" type="text" class="form-control @error('value') is-invalid @enderror" value="{{ $command->value }}" name="value" required autocomplete="value" autofocus>

                        @error('value')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                    <div class="col-md-6">
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" autofocus required>
                            <option value="">{{ __('categories') }}</option>
                            @foreach ($categories as $category)
                                @if ($category->id === $command->category_id)
                                    <option value="{{ $category->id }}" default>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>

                        @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                    <div class="col-md-6">
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" autofocus required>
                            <option value="">{{ __('status') }}</option>
                            @if ($command->status === 'enabled')
                                <option value="enabled" default>{{ __('Enabled' )}}</option>
                                <option value="disabled">{{ __('Disabled' )}}</option>
                            @else              
                                <option value="enabled">{{ __('Enabled' )}}</option>
                                <option value="disabled" default>{{ __('Disabled' )}}</option>
                            @endif
                        </select>

                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update Command') }}
                        </button>
                        <a href="/commands" role="button" class="btn btn-info">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection