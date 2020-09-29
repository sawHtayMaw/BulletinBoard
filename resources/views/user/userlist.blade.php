@extends('layouts.app')

@section('users-active', 'active')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <form action="{{ route('users#search') }}" method="POST" role="search">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-lg-2 col-md-4 col-9 mb-2">
            <input type="text" class="form-control" name="name" placeholder="Name" value="@if(isset($name)) {{ $name }} @endif">
          </div>
          <div class="col-lg-2 col-md-4 col-9 mb-2">
            <input type="text" class="form-control" name="email" placeholder="Email" value="@if(isset($email)) {{ $email }} @endif">
          </div>
          <div class="col-lg-2 col-md-4 col-9 mb-2">
            <input type="date" class="form-control" name="createdfrom" placeholder="Created From" value=@if(isset($createdFrom)) {{ $createdFrom }} @endif>
          </div>
          <div class="col-lg-2 col-md-4 col-9 mb-2">
            <input type="date" class="form-control" name="createdto" placeholder="Created To" value=@if(isset($createdTo)) {{ $createdTo }} @endif>
          </div>
          <div class="col-lg-2 col-md-4 col-4 mb-2"><input type="submit" class="btn btn-primary display-block w-100 pd-2" value="Search"></div>
          @auth
            <div class="col-lg-2 col-md-4 col-2 mb-2"><a href="{{ route('users#create') }}" class="btn btn-primary w-100 pd-2">Add</a></div>
          @endauth
        </div>
      </form>
      @if(isset($userList))
        @if(sizeof($userList) > 0)
          <div class="table-responsive">
            <table class="table table-bordered text-nowrap">
              <thead class="text-center">
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Created User</th>
                  <th>Phone</th>
                  <th>Birth Date</th>
                  <th>Address</th>
                  <th>Created Date</th>
                  <th>Updated Date</th>
                  @auth
                    <th colspan="2">Actions</th>
                  @endauth
                </tr>
              </thead>
              <tbody class="text-center">
                @foreach($userList as $user)
                <tr>
                <td>{{$user-> name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->user->name}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->dob}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->created_at->format('Y-m-d')}}</td>
                <td>{{$user->updated_at->format('Y-m-d')}}</td>
                @auth
                <td>
                        <form action="{{ route('users#delete', $user->id)}}" method="delete">
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
          @endif
          @endif
          </div>
      @if($userList instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <center>{!! $userList->render() !!}</center>
      @endif
    </div>
  </div>
</div>
@endsection
