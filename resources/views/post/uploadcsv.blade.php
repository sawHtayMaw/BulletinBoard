@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white">Upload CSV File</div>
          <div class="card-body">
          <div class="container col-8">
              @if (\Session::has('message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {!! \Session::get('message') !!}
                </div>
              @endif
              <form action="{{ route('posts#upload') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <label for="csvfile" class="form-label">Import File From : </label>
                <div class="col-md-12 mt-3 mb-2">
                    <input id="csvfile" type="file" accept=".csv" class="col-md-8 @error('csvfile') is-invalid @enderror" name="csvfile"  autocomplete="csv" autofocus>
                </div>
                @error('csv')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <input type="submit" class="btn btn-primary mt-3" value="Import File">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
