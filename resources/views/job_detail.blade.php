@extends('layouts.main')

{{-- TITLE --}}
@section('title')
  Job History
@endsection

{{-- CARD HEADER --}}
@section('card_header')
  Job History
@endsection

{{-- CONTENT --}}
@section('content')
{{-- BUTTON TAMBAH --}}
<a href="{{ route('jobs.index') }}" class="mb-4 btn icon icon-left btn-success"><i class="bi bi-plus"></i>
  Add New Job</a>
{{-- END BUTTON TAMBAH --}}

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
              <th>Date</th>
              <th>Invoice Code</th>
              <th>Boss</th>
              <th>Payment Status</th>
              <th>Total Payment</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($jobs as $key => $job)
              <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $job->start_date }}</td>
                  <td>{{ $job->invoice_code }}</td>
                  <td>{{ $job->boss->name }}</td>
                  <td>
                    <span class="{{ $job->payment_status == 'belum bayar' ? 'badge bg-danger' : 'badge bg-success' }}">
                      {{ $job->payment_status == 'belum bayar' ? 'Belum Dibayar' : 'Dibayar' }}
                    </span>
                  </td>
                  <td>{{ $job->total_payment }}</td>
                  <td>
                      <a href="{{ route('detail_job_detail.index', ['idtransaksi' => $job->id, 'kode' => $job->invoice_code]) }}"
                          class="btn icon icon-left btn-primary" type="button">
                          <i class="bi bi-pencil-square"></i>
                      </a>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                          data-bs-target="#defaultSize{{ $job->id }}">
                          <i class="bi bi-trash"></i>
                      </button>
                      <div class="modal fade text-left" id="defaultSize{{ $job->id }}"
                          tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true"
                          style="display: none;">
                          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                              role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="modal-title" id="myModalLabel18">Hapus Data Job
                                      </h4>
                                      <button type="button" class="close"
                                          data-bs-dismiss="modal" aria-label="Close">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                              height="24" viewBox="0 0 24 24" fill="none"
                                              stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"
                                              class="feather feather-x">
                                              <line x1="18" y1="6" x2="6" y2="18"></line>
                                              <line x1="6" y1="6" x2="18" y2="18"></line>
                                          </svg>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <h5>Yakin Ingin Menghapus Data Job?</h5>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button"
                                          class="btn btn-light-secondary"
                                          data-bs-dismiss="modal">
                                          <i class="bx bx-x d-block d-sm-none"></i>
                                          <span class="d-none d-sm-block">Tidak</span>
                                      </button>
                                      <form method="post"
                                          action="{{ route('job_detail.delete', $job->id) }}">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit"
                                              class="btn btn-primary ml-1"
                                              data-bs-dismiss="modal">
                                              <i class="bx bx-check d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Ya</span>
                                          </button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
</div>

@endsection

@section('script')
{{-- SCRIPT --}}

{{-- SCRIPT END --}}
@endsection
