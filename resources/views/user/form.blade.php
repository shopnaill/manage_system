<div class="row mt-4">
    <div class="col-md-6">
        <div class='form-group'>
            <label for="name">Name</label>
            <input type="text" value="@if (isset($user)){{  $user->name}} @endif" name="name" id="name" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
            <div class='form-group'>
                <label for="email">Email</label>
                <input type="email" value="@if (isset($user)){{  $user->email}} @endif" name="email" id="email" class="form-control">
            </div>
        </div>
</div>

@if(isset($new))
<div class="row mt-4">
        <div class="col-md-12">
            <div class='form-group'>
                <label for="password">Password</label>
                <input type="password"  name="password" id="password" class="form-control">
            </div>
        </div>
       
 </div>
@endif

<div class="row">
    @if ($admin  || $role == 3)
     <div class="col-md-6">
        <div class='form-group'>
          <label for="role">Role</label>
           <select class="form-control" id="role" name="role">
              <option @if (isset($user) && $user->role == null) {{'selected'}} @endif value="user">Only User</option>
              <option  @if (isset($user) && $user->role == 1) {{'selected'}} @endif value="1">Controller</option> 
              <option  @if (isset($user) && $user->role == 2) {{'selected'}} @endif value="2">Manager</option>
              @if ($role ==3 || $admin)
              <option  @if (isset($user) && $user->role == 3) {{'selected'}} @endif value="3">Admin</option>
              @endif
           </select>
        </div>
        </div>
    <div class="col-md-6">
        <div class='form-group'>
                <label for="photo">Photo</label>
                <input id="photo" type="file" class="form-control" name="photo" />
        </div>
    </div>    
    @else
    <div class="col-md-12">
            <div class='form-group'>
                    <label for="photo">Photo</label>
                    <input id="photo" type="file" class="form-control" name="photo" />
            </div>
        </div>
    @endif
</div>




<hr>
<div class="row d-block">
    <div class="col-md-12 text-center mb-3">
        <input type="submit" class="btn btn-primary" value="{{$submitButtonText}}">
    </div>
    
</div>