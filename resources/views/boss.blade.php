@extends('layouts.main')

{{-- TITLE --}}
@section('title')
  Boss
@endsection

{{-- CARD HEADER --}}
@section('card_header')
  Boss
@endsection

{{-- CONTENT --}}
@section('content')
{{-- BUTTON TAMBAH --}}
<a href="" class="mb-4 btn icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#default"><i class="bi bi-person-plus-fill"></i>
  Add New Boss</a>
{{-- END BUTTON TAMBAH --}}
{{-- MODAL TAMBAH  --}}
<div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel33">Add Boss</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>

      <form action="/tambah-data-boss" method="post" enctype="multipart/form-data">
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
                <label>Address: </label>
                <input type="text" placeholder="Address" class="form-control" name="address" value="">
              </div>
            </div>

            <div class="col-md-12 col-12">
              <div class=" form-group">
                <label>Phone: </label>
                <input type="text" placeholder="Phone" class="form-control" name="phone" value="">
              </div>
            </div>

            <div class="col-md-12 col-12">
              <div class=" form-group">
                <label>Status: </label>
                <select class="form-select" name="status">
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
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
  <table class="table  mb-3" id="table1">
    <thead class="thead-dark">
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 0 ?>
      @foreach ($bosses as $boss)
        <?php $no++ ?>
        <tr>
          <td><?= $no ?></td>
          <td>{{ $boss->name }}</td>
          <td>{{ $boss->address }}</td>
          <td>{{ $boss->phone }}</td>
          <td>{{ $boss->status }}</td>
          <td>
            {{-- BUTTON UPDATE --}}
            <a href="" class="btn icon icon-left btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#editModal" onclick="updateBoss('{{ $boss->id }}', '{{ $boss->name }}', '{{ $boss->address }}', '{{ $boss->phone }}', '{{ $boss->status }}')"><i class="bi bi-pencil-square"></i></a>
            {{-- BUTTON UPDATE --}}

            {{-- BUTTON DELETE --}}
            <button type="button" class="btn icon icon-left btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteBoss('{{ $boss->id }}')"><i class="bi bi-trash3"></i></button>
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
        <h4 class="modal-title" id="myModalLabel33">Update Boss</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>

      <form id="form-update-boss" method="post" enctype="multipart/form-data">
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
                <label>Address: </label>
                <input id="update-address" type="text" placeholder="Address" class="form-control" name="address">
              </div>
            </div>
          

            <div class="col-md-12 col-12">
              <div class=" form-group">
                <label>Phone: </label>
                <input id="update-phone" type="text" placeholder="Phone" class="form-control" name="phone">
              </div>
            </div>
          
            <div class="col-md-12 col-12">
              <div class=" form-group">
                <label>Status: </label>
                <select class="form-select" id="update-status" name="status">
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
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

          <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" name="simpan" value="SIMPAN DATA">
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
              <h5 class="modal-title white" id="myModalLabel120">Delete Boss</h5>
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
              <a href="" class="btn btn-danger ml-1" id="link_delete_boss">
                  <i class="bx bx-check d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Delete</span>
              </a>
          </div>
      </div>
  </div>
</div>
{{-- END MODAL DELETE --}}
@endsection

@section('script')
{{-- SCRIPT --}}
<script>
  function updateBoss(id, name, address, phone, status) {
    var link = "/update-data-boss/" + id;
    document.getElementById('update-name').value = name;
    document.getElementById('update-address').value = address;
    document.getElementById('update-phone').value = phone;

    // Set status selected based on the data
    var statusSelect = document.getElementById('update-status');
    for (var i = 0; i < statusSelect.options.length; i++) {
      if (statusSelect.options[i].value === status) {
        statusSelect.options[i].selected = true;
        break;
      }
    }

    document.getElementById('form-update-boss').action = link;
  }

  function deleteBoss(id) 
  {
    var link = "/delete-data-boss/" + id;
    document.getElementById('link_delete_boss').href = link;
  }

</script>
{{-- SCRIPT END --}}
@endsection