@extends('layouts.main')

{{-- TITLE --}}
@section('title')
  Profile
@endsection

{{-- CARD HEADER --}}
@section('card_header')
Profile
@endsection

{{-- CONTENT --}}
@section('content')

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


<form action="{{ route('profile.edit') }}" method="post">
  @csrf
  <div class="modal-body">
      <input type="hidden" name="id" value="{{ $dataUserProfile['id'] }}">
      <label>Name : </label>
      <div class="form-group col-md-6 col-12">
          <input type="text" placeholder="Name" class="form-control" name="name" value="{{ $dataUserProfile['name'] }}">
      </div>
      <label>Username: </label>
      <div class="form-group col-md-6 col-12">
          <input type="text" placeholder="Username" class="form-control" name="username" value="{{ $dataUserProfile['username'] }}">
      </div>
      <label>Role: </label>
      <div class="form-group col-md-6 col-12">
          <input type="text" placeholder="Role" class="form-control" value="{{ $dataUserProfile['user_role'] }}" readonly>
      </div>
  </div>
  <div class="modal-footer">
      <button class="btn icon icon-left btn-primary m-2" type="submit" name="edit">Edit Profile</button>
      <a href="" class="btn icon icon-left btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#ubahPass">Ubah Password</a>
  </div>
</form>

<div class="modal fade text-left" id="ubahPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel33">Ubah Password</h4>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <i data-feather="x"></i>
              </button>
          </div>
          <form action="{{ route('profile.changePassword') }}" method="post">
              @csrf
              <div class="modal-body">
                  <label>Password Lama : </label>
                  <div class="form-group">
                      <input type="password" class="form-control" name="passLama">
                  </div>
                  <label>Password Baru : </label>
                  <div class="form-group">
                      <input type="password" class="form-control" name="passBaru">
                  </div>
                  <label>Konfirmasi Password Baru : </label>
                  <div class="form-group">
                      <input type="password" class="form-control" name="passKonfir">
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                      <i class="bx bx-x d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Close</span>
                  </button>
                  <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" name="ubahPassword" value="EDIT DATA">
                      <input type="hidden" name="id" value="{{ $dataUserProfile['id'] }}">
                      <i class="bx bx-check d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Update</span>
                  </button>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection

@section('script')

@endsection