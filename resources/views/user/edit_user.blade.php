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
                <div class="card-header">Edit User</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
  @if(isset($user))
  <form action="{{action('UserController@update',['id' => $user->id])}}" method="post" enctype="multipart/form-data">
  @csrf
    @include('user.form', ['submitButtonText' => __('Save Profile')])
    </form>
  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

