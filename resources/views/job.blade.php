@extends('layouts.main')

{{-- TITLE --}}
@section('title')
  Job
@endsection

{{-- CARD HEADER --}}
@section('card_header')
  <center>Job</center>
@endsection

{{-- CONTENT --}}
@section('content')

<form class="form" action="{{ route('jobs.store') }}" method="post">
  @csrf
  <div class="row">
    <center>
      <h3>Invoice Code</h3>
      <div class="col-md-3">
        @php
          use App\Models\Job;
          $currentDate = date('ymd');
            $lastInvoice = Job::where('invoice_code', 'like', $currentDate . '%')
            ->orderBy('id', 'desc')
            ->first();

        $sequentialNumber = $lastInvoice ? intval(substr($lastInvoice->invoice_code, -2)) + 1 : 1;
        $sequentialNumber = str_pad($sequentialNumber, 2, '0', STR_PAD_LEFT);
        $invoiceCode = $currentDate . $sequentialNumber;
        @endphp
          <input class="form-control alert alert-secondary" name="invoice_code" value="{{ $invoiceCode }}" style="text-align: center; font-size: 21px;" readonly="">
      </div>
  </center>

  <div class="col-md-4 col-12">
    <div class="form-group">
      <label for="admin_id">Admin</label>
      <input type="text" id="admin_id" class="form-control" value="{{ auth()->user()->name }}" readonly>
      <input type="text" class="form-control" name="admin_id" value="{{ auth()->user()->id }}" hidden required>
    </div>
  </div>

  <div class="col-md-4 col-12">
    <div class="form-group">
        <label for="boss_id">Boss</label>
        <div class="form-group">
            <select class="form-select" id="boss_id" name="boss_id">
                @foreach ($bosses as $boss)
                    <option value="{{ $boss['id'] }}">{{ $boss['name'] }}</option>
                @endforeach
            </select>
          </div>
      </div>
  </div>

  <div class="col-md-4 col-12">
    <div class="form-group">
      <label for="start_date">Start Date</label>
      <input type="date" id="start_date" class="form-control" placeholder="Start Date" name="start_date" required>
    </div>
  </div>

  <div class="col-md-4 col-12">
    <div class="form-group">
      <label for="payment_date">Payment Date</label>
      <input type="date" id="payment_date" class="form-control" placeholder="Payment Date" name="payment_date">
    </div>
  </div>

  <div class="col-md-4 col-12">
    <div class="form-group">
        <label for="payment_status">Payment Status</label>
        <div class="form-group">
            <select class="form-select" id="payment_status" name="payment_status">
                    <option value="belum bayar">Belum Bayar</option>
                    <option value="dibayar">Dibayar</option>
            </select>
          </div>
      </div>
  </div>

  <div class="col-md-4 col-12">
    <div class="form-group">
      <label for="total_payment">Total Harga</label>
      <input class="form-control" type="text" name="total_payment" id="total_payment" readonly="">
    </div>
  </div>

  <div class="col-12">
    <div class="form-group">
      <label for="">
        <h6>Service</h6>
      </label>
      <div class="table-responsive">
        <table class="table table-bordered mb-0">
          <thead>
            <tr>
              <th>No</th>
              <th>Service Name</th>
              <th>Price</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            @php $i = 0; @endphp
            @foreach ($services as $service)
            @php $i++; @endphp
              <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $service->service_name }}</td>
                  <td>
                      <input type="number" value="0" name="price{{ $service->id }}" id="price{{ $service->id }}" class="form-control" onchange="hitung()">
                  </td>
                  <td>
                      <input type="text" name="description{{ $service->id }}" id="" value=" " class="form-control">
                  </td>
              </tr>
            @endforeach
        </tbody>        
        </table>
      </div>
    </div>
  </div>

      <div class="col-12 d-flex justify-content-end">
          <button name="simpan" id="simpan" type="submit"
              class="btn btn-primary me-1 mb-1">Submit</button>
          <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
      </div>
  </div>
</form>


@endsection

@section('script')
{{-- SCRIPT --}}
<script>
  function hitung() 
  {
  var totalHarga = 0;

  // Hitung total harga
  <?php $i = 0 ?>
  <?php foreach ($services as $service) : ?>
    <?php $idService = $service['id'] ?>
    var inputan = document.getElementById('price<?= $idService ?>').value;
    totalHarga += inputan ? parseInt(inputan) : 0;
    <?php $i++ ?>
  <?php endforeach ?>

  // Tambahan logika atau perhitungan lainnya sesuai kebutuhan

  // Tampilkan total harga pada input dengan id total_payment
  document.getElementById('total_payment').value = totalHarga;
}
</script>
@endsection
{{-- SCRIPT END --}}

