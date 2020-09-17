@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white">Confirm Update Post</div>
          <div class="card-body">
            <form action="{{ route('posts#updated', $post['id']) }}" method="POST">
              @csrf
              <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                <div class="col-md-6">
                  <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                   value="{{   $post['title']  }}" autofocus>

                  @error('title')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                <div class="col-md-6">
                  <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                    name="description">{{   $post['description']  }}</textarea>

                  @error('description')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right pt-0">{{ __('Status') }}</label>
                <div class="col-md-6">
                  <input type="checkbox" name="status" id="status" class="pt-1" @if ($post['status'] == '1')
                  checked="checked"
                  @endif>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Update') }}
                  </button>
                  <button type="reset" class="btn btn-danger">
                    {{ __('Cancel') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
