@extends('layouts.app')

@section('content')
<div class="container">
 @if(session()->has('info'))
        <div class="alert alert-info">
            {{ __(session()->get('info')) }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($role == 3 || $admin)
                      <a class="btn btn-primary" href="{{route('user.create')}}">Create User</a>
                    @endif
                    <hr>
  @if(isset($users))

                   <table class="table">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   @foreach ($users as $user)
       
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
        
        @if ($user->role == null && !$user->admin)
             {{'Only User'}} 
          @elseif ($user->role == null && $user->admin)
             <strong class="text-success">Administrator</strong>
        @elseif ($user->role == 1)
             <strong class="text-warn">Controller</strong>
        @elseif ($user->role == 2)
             <strong class="text-danger">Manager</strong>
        @elseif ($user->role == 3)
             <strong class="text-success">Admin</strong>
        @endif
      </td>
      <td style="width: 200px;">
      @if ($role == 1)
            <a a  href="{{route('user.show',['id' => $user->id])}}" class="btn btn-success btn-sm">View</a>
      @elseif ($role == 2)
           @if ( !$user->admin || $admin && $user->id == Auth::user()->id)
            <a  href="{{route('user.edit',['id' => $user->id])}}" class="btn btn-info btn-sm">Edit</a>
            @endif
            <a  href="{{route('user.show',['id' => $user->id])}}" class="btn btn-success btn-sm">View</a>
      @elseif ($role == 3 || $admin )
           @if ( !$user->admin || $admin && $user->id == Auth::user()->id)
            <a  href="{{route('user.edit',['id' => $user->id])}}" class="btn btn-info btn-sm">Edit</a>
            @endif            
            <a  href="{{route('user.show',['id' => $user->id])}}" class="btn btn-success btn-sm">View</a>
            @if ( !$user->admin && $user->role !=3 || $user->role != 3 && !$user->admin )
            <div data-toggle="modal" data-target="#deleteModal{{$user->id}}" class="btn btn-danger btn-sm">Delete</div>
            @endif
      @endif

      </td>
    </tr>

     
   @endforeach

  </tbody>
</table>
@if(isset($users))
  @foreach ($users as $user)
      @if ($role == 3 || $admin)
      
      @include('user.delete')

      @endif
   @endforeach
@endif


@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

