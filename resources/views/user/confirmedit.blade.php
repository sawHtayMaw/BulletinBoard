@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card border-primary">
        <div class="card-header bg-primary text-white">{{ __('Confirm Edit User') }}</div>
        <div class="card-body">
        <img src="{{ url('/storage/' . $user->profile) }}" class="position-absolute profile d-inline img-thumbnail right">
          <form action="{{ route('users#updated', $user['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
              <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                 value="@if(asset($user['name'])) {{ $user['name'] }} @endif"  autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail') }}</label>
              <div class="col-md-6">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                value="@if(asset($user['email'])) {{ $user['email'] }} @endif" autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
                <label for="type" class="col-md-3 col-form-label text-md-right">{{ __('Type') }}</label>
                <div class="col-md-6">
                  <input id="type" type="text" class="form-control text-md-left" name="type"
                  value="{{ $user['type'] }}" readonly="readonly">
                </div>
              </div>

            <div class="form-group row">
              <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Phone') }}</label>
              <div class="col-md-6">
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                value="@if(asset($user['phone'])) {{ $user['phone'] }} @endif" autocomplete="phone" autofocus>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            </div>

            <div class="form-group row">
              <label for="dob" class="col-md-3 col-form-label text-md-right">{{ __('Date of Birth') }}</label>
              <div class="col-md-6">
                <input id="dob" type="text" class="form-control @error('dob') is-invalid @enderror" name="dob"
                value="@if(asset($user['dob'])) {{ $user['dob'] }} @endif" autocomplete="dob" autofocus>
                @error('dob')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            </div>

            <div class="form-group row">
              <label for="address" class="col-md-3 col-form-label text-md-right">{{ __('Address') }}</label>
              <div class="col-md-6">
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                value="@if(asset($user['address'])) {{ $user['address'] }} @endif" autocomplete="address" autofocus>
                @error('address')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            </div>

            <div class="form-group row d-none">
                <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Profile') }}</label>
                <div class="col-md-6">
                  <input id="profile" type="text" class="form-control @error('profile') is-invalid @enderror"
                    name="profile" value="{{ $user['profile'] }}" autocomplete="profile" autofocus>
                    @error('profile')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
              </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Update') }}
                </button>
                <a href="{{ route('users#edit', $user->id) }}" class="btn btn-danger">
                    {{ __('Cancel') }} </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
