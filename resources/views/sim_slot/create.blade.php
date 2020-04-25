@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header">{{ __('Add Sim Slot') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('sim_slots.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="phone_num" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                    <div class="col-md-6">
                        <input id="phone_num" type="phone" class="form-control @error('phone_num') is-invalid @enderror" name="phone_num" required autocomplete="phone" autofocus>

                        @error('phone_num')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="provider" class="col-md-4 col-form-label text-md-right">{{ __('Service Provider') }}</label>

                    <div class="col-md-6">
                        <select name="provider" id="provider" class="form-control @error('provider') is-invalid @enderror" autofocus required>
                            <option value="" default>{{ __('Providers') }}</option>
                            <option value="mtn">{{ __('MTN' )}}</option>
                            <option value="glo">{{ __('GLO' )}}</option>
                            <option value="airtel">{{ __('Airtel' )}}</option>
                            <option value="9mobile">{{ __('9Mobile' )}}</option>
                        </select>

                        @error('provider')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="balance" class="col-md-4 col-form-label text-md-right">{{ __('Balance') }}</label>

                    <div class="col-md-6">
                        <input id="balance" type="number" class="form-control @error('balance') is-invalid @enderror" name="balance" required autocomplete="balance" autofocus />

                        @error('balance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add Sim') }}
                        </button>
                        <a href="/sim_slots" role="button" class="btn btn-info">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection