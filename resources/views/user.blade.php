@extends('layouts.main')

{{-- TITLE --}}
@section('title')
  User
@endsection

{{-- CARD HEADER --}}
@section('card_header')
  User
@endsection

{{-- CONTENT --}}
@section('content')
{{-- BUTTON TAMBAH --}}
<a href="" class="mb-4 btn icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#default"><i class="bi bi-person-plus-fill"></i>
  Add New User</a>
{{-- END BUTTON TAMBAH --}}
{{-- MODAL TAMBAH  --}}
<div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel33">Add User</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>

      <form action="/tambah-data-user" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12 col-12">
              <div class=" form-group">
                <label>Name: </label>
                <input type="text" placeholder="Name" class="form-control" name="name" value="">
              </div>
            </div>

            <div class="col-md-12 col-12">
              <div class=" form-group">
                <label>Username: </label>
                <input type="text" placeholder="Username" class="form-control" name="username" value="">
              </div>
            </div>

            <div class="col-md-12 col-12">
              <div class=" form-group">
                <label>User Role: </label>
                <select class="form-select" id="basicSelect" name="user_role">
                  <option value="owner">Owner</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
          </button>
          <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" name="simpan" value="save">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Save</span>
          </button>
        </div>
      </form>

    </div>
  </div>
</div>
{{-- END MODAL TAMBAH  --}}

{{-- ALERT --}}
@if ($message = Session::get('success'))
  <div class="alert alert-light-success color-success alert-dismissible show fade">
    <i class="bi bi-check-circle"></i>
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@elseif ($message = Session::get('error'))
  <div class="alert alert-light-danger color-danger alert-dismissible show fade">
    <i class="bi bi-exclamation-triangle"></i>
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif


<div class="table-responsive">
  <table class="table mb-3" id="table1">
    <thead class="thead-dark">
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Username</th>
        <th>User Role</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 0 ?>
      @foreach ($users as $user)
        <?php $no++ ?>
        <tr>
          <td><?= $no ?></td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->user_role }}</td>
          <td>
            {{-- BUTTON RESET PASS --}}
            <button type="button" class="btn icon icon-left btn-secondary" data-bs-toggle="modal" data-bs-target="#resetPass" onclick="resetPass('{{ $user->id }}')"><i class="bi bi-arrow-clockwise"></i></button>
            {{-- END BUTTON RESET PASS --}}

            {{-- BUTTON UPDATE --}}
            <a href="" class="btn icon icon-left btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#editModal" onclick="updateUser('{{ $user->id }}', '{{ $user->name }}', '{{ $user->username }}', '{{ $user->user_role }}')"><i class="bi bi-pencil-square"></i></a>
            {{-- BUTTON UPDATE --}}

            {{-- BUTTON DELETE --}}
            <button type="button" class="btn icon icon-left btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteUser('{{ $user->id }}')"><i class="bi bi-trash3"></i></button>
            {{-- END BUTTON DELETE --}}

          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>

{{-- MODAL UPDATE --}}
<div class="modal fade text-left" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel33">Update User</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>

      <form id="form-update-user" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">
            
            <div class="col-md-12 col-12">
              <div class=" form-group">
                <label>Name: </label>
                <input id="update-name" type="text" placeholder="Name" class="form-control" name="name">
              </div>
            </div>
          

            <div class="col-md-12 col-12">
              <div class=" form-group">
                <label>Username: </label>
                <input id="update-username" type="text" placeholder="Username" class="form-control" name="username">
              </div>
            </div>
          

            <div class="col-md-12 col-12">
              <div class=" form-group">
                <label>User Role: </label>
                <select class="form-select" id="update-user-role" name="user_role">
                  <option value="owner">Owner</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
            </div>
          
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Back</span>
          </button>

          <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" name="simpan">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Save</span>
          </button>

        </div>
      </form>
    </div>
  </div>
</div>
{{-- END MODAL UPDATE --}}

{{-- MODAL DELETE --}}
<div class="modal fade text-left" id="deleteModal" tabindex="-1" aria-labelledby="myModalLabel120" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
          <div class="modal-header bg-danger">
              <h5 class="modal-title white" id="myModalLabel120">Delete User</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
              </button>
          </div>
          <div class="modal-body">
              Are U Sure To Delete this?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                  <i class="bx bx-x d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Cancel</span>
              </button>
              <a href="" class="btn btn-danger ml-1" id="link_delete_user">
                  <i class="bx bx-check d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Delete</span>
              </a>
          </div>
      </div>
  </div>
</div>
{{-- END MODAL DELETE --}}

{{-- MODAL DEFAULT PASSWORD --}}
<div class="modal fade text-left" id="resetPass" tabindex="-1" aria-labelledby="myModalLabel120" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
          <div class="modal-header bg-primary">
              <h5 class="modal-title white" id="myModalLabel120">Set Password To Default</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
              </button>
          </div>
          <div class="modal-body">
            Are you sure you want to reset the password to the default setting?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                  <i class="bx bx-x d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Cancel</span>
              </button>
              <form id="resetPassForm" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Yes</span>
                </button>
            </form>
          </div>
      </div>
  </div>
</div>
{{-- END MODAL DEFAULT PASSWORD --}}
@endsection

@section('script')
{{-- SCRIPT --}}
<script>
  function updateUser(id, name, username, user_role)
  {
    var link = "/update-data-user/" + id;
    document.getElementById('update-name').value = name;
    document.getElementById('update-username').value = username;
    // Set user role selected based on the data
    var userRoleSelect = document.getElementById('update-user-role');
    for (var i = 0; i < userRoleSelect.options.length; i++) {
      if (userRoleSelect.options[i].value === user_role) {
        userRoleSelect.options[i].selected = true;
        break;
      }
    }
    document.getElementById('form-update-user').action = link;
  }

  function deleteUser(id) 
  {
    var link = "/delete-data-user/" + id;
    document.getElementById('link_delete_user').href = link;
  }

  function resetPass(id) {
    var link = "/user/setDefaultPassword/" + id;
    document.getElementById('resetPassForm').action = link;
    
  }

</script>
{{-- SCRIPT END --}}
@endsection