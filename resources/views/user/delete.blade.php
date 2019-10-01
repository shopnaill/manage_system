<div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModal{{$user->id}}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModal{{$user->id}}">Delete User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure from deleting this user?
        <form action="{{action('UserController@delete',['id' => $user->id])}}" method="post">
  @csrf
        <input id="del{{$user->id}}" style="display:none;" type="submit"  class="btn btn-danger">
</form>
      </div>
      <div class="modal-footer">
        <label type="button" class="btn btn-secondary" data-dismiss="modal">Close</label>
        <label for="del{{$user->id}}" class="btn btn-danger">Delete</label>
      </div>
    </div>
  </div>
</div>