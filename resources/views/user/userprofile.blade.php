@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card border-primary">
        <div class="card-header bg-primary text-white">{{ __('User Profile') }}</div>
        <div class="card-body">
          <div class="row">
            <a href="{{ route('users#edit', $user->id) }}" class="col-md-4 col-form-label text-md-right">Edit</a>
          </div>
          <div class="form-group row">
                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control" readonly="readonly" name="name" value="{{ $user->name }}" autofocus>
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-mail') }}</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" readonly="readonly" name="email" value="{{ $user->email }}" autofocus>
                </div>
              </div>

              <div class="form-group row">
                <label for="type" class="col-md-3 col-form-label text-md-right">{{ __('Type') }}</label>
                <div class="col-md-6">
                  <input id="type" type="text" class="form-control" readonly="readonly" name="type" value="{{ $user->type }}" autofocus>
                </div>
              </div>

              <div class="form-group row">
                <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Phone') }}</label>
                <div class="col-md-6">
                  <input id="phone" type="number" class="form-control" readonly="readonly" name="phone" value="{{ $user->phone }}" autofocus>
                </div>
              </div>

              <div class="form-group row">
                <label for="dob" class="col-md-3 col-form-label text-md-right">{{ __('Date Of Birth') }}</label>
                <div class="col-md-6">
                  <input id="dob" type="text" class="form-control" readonly="readonly" name="dob" value="{{ $user->dob }}" autofocus>
                </div>
              </div>

              <div class="form-group row">
                <label for="address" class="col-md-3 col-form-label text-md-right">{{ __('Address') }}</label>
                <div class="col-md-6">
                  <input id="address" type="text" class="form-control" readonly="readonly" name="address" value="{{ $user->address }}" autofocus>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
