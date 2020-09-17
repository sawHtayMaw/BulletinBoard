@extends('layouts.app')

@section('posts-active', 'active')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-9">
      <form action="{{ route('posts#search') }}" method="POST" role="search">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-lg-4 col-md-8 col-8 mb-2">
          <input type="text" class="form-control" name="q" value="@if(isset($q)) {{ $q }} @endif">
          </div>
          <div class="col-lg-2 col-md-4 col-4 mb-2"><input type="submit" class="btn btn-primary display-block w-100 pd-2" value="Search"></div>
          @auth
            <div class="col-lg-2 col-md-4 col-4 mb-2"><a href="{{ route('posts#create') }}" class="btn btn-primary w-100 pd-2">Add</a></div>
            <div class="col-lg-2 col-md-4 col-4 mb-2"><a href="{{ route('posts#showUpload') }}" class="btn btn-primary w-100 pd-2">Upload</a></div>
            <div class="col-lg-2 col-md-4 col-4 mb-2"><a href="{{ route('posts#download') }}" class="btn btn-primary w-100 pd-2">Download</a></div>
          @endauth
        </div>
      </form>
      @if(isset($postList))
        @if(sizeof($postList) > 0)
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="text-center">
                <tr>
                  <th>Post Title</th>
                  <th>Post Description</th>
                  <th>Posted User</th>
                  <th>Posted Date</th>
                  @auth
                 <th colspan="2">Actions</th>
                 @endauth
                </tr>
              </thead>
              <tbody class="text-center">
                @foreach($postList as $post)
                <tr>
                <td>{{$post -> title }}</td>
                <td>{{$post -> description}}</td>
                <td>{{$post -> user -> name}}</td>
                <td>{{$post-> created_at->format('Y/m/d')}}</td>
                @auth
                <td><a href="{{ route('posts#update', $post->id)}}">Edit</a></td>
                <td>
                        <form action="{{ route('posts#delete', $post->id)}}" method="delete">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                        </form>
                    </td>
                @endauth
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @if($postList instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <center>{!! $postList->render() !!}</center>
      @endif
          </div>
        @endif
      @endif
    </div>
  </div>
</div>
@endsection
