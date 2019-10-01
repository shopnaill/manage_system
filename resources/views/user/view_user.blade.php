@extends('layouts.app')
<style>
.card-img
{
     height: 159px;
    padding: 15px;
}
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
      @if(isset($user))
       
        <div class="card mb-3" style="width: 100%; max-width: 520px;">
        <div class="row no-gutters">
            <div class="col-md-4">
            @if ($user->photo)
            <?php
             $s = str_replace('public/','',$user->photo);
             ?>
            <img  src="{{ asset('storage/'.$s)}}" class="card-img" alt="User Image">
            @else
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRs9z_O5m1RCirZug1dv5zJ41KdzOqwHNyExxX_7YQCCZK6SWTmSQliazmdKA" class="card-img" alt="User Image">
            @endif
            </div>
            <div class="col-md-8">
            <div class="card-body">
               <h5 class="card-title">{{$user->name}}</h5>
              Role :
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

            <p class="card-text"><small class="text-muted"><a href="mailto:{{$user->email}}">{{$user->email}}</a></small></p>
            @if (Auth::user()->id == $user->id || $role == 3 && !$user->admin  || $admin && !$user->admin && Auth::user()->id != $user->id)
            <a  class="btn btn-sm btn-success" href="{{route('user.edit',['id' => $user->id])}}">Edit</a>
            @endif
            </div>
            </div>
 
        </div>
        </div>

      @endif
    </div>
</div>
@endsection

