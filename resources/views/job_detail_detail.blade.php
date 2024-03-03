@extends('layouts.main')

{{-- TITLE --}}
@section('title')
  Detail Job
@endsection

{{-- CARD HEADER --}}
@section('card_header')
  Detail Job
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

<div class="row">
  <div class="col-sm-6">
      <div class="form-group">
          <table class="table">
              <tbody>
                  <tr>
                      <td>Invoice Code</td>
                      <td>: {{ $job->invoice_code }}</td>
                      <input type="hidden" name="kode_invoice" id="kode_invoice" value="{{ $job->invoice_code }}">
                  </tr>
                  <tr>
                      <td>Boss</td>
                      <td>: {{ $job->boss->name }}</td>
                  </tr>
                  <tr>
                      <td>Date</td>
                      <td>: {{ $job->start_date }}</td>
                  </tr>
                  <tr>
                      <td>Payment Date</td>
                      <td>: {{ $job->payment_date }}</td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
  <div class="col-sm-6">
      <div class="form-group">
          <table class="table">
              <tbody>
                <tr>
                  <td>Payment Date</td>
                  <td>: {{ $job->payment_status }}</td>
              </tr>
              <tr>
                <td>Total Payment</td>
                <td>: {{ $job->total_payment }}</td>
            </tr>
            <tr>
              <td>Admin</td>
              <td>: {{ $job->admin->name }}</td>
            </tr>
              </tbody>
          </table>
      </div>
  </div>
</div>
<div>
  <div class="col-sm-12">
      <table class="table table-bordered">
          <thead class="text-center">
              <tr>
                <th>No</th>
                <th>Service Name</th>
                <th>Price</th>
                <th>Description</th>
              </tr>
          </thead>
          <tbody class="text-center">
            @php $no = 0 @endphp
            @foreach ($job_detail as $detail)
                @php $no++ @endphp
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $detail->service->service_name }}</td>
                    <td>{{ $detail->price }}</td>
                    <td>{{ $detail->description }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
  </div>
  @include('modal_edit_detail')

</div>
@endsection

@section('script')
{{-- SCRIPT --}}

{{-- SCRIPT END --}}
@endsection
