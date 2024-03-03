<button type="button" data-bs-toggle="modal" data-bs-target="#normal" class="btn btn-warning"><i class="fa fa-address-book"></i>Edit Data</button>

<div class="modal fade text-left" id="normal" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">Edit Transaksi</h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
      <div class="modal-body">
        <form class="form" method="post" action="{{ route('detail_job_detail.update', ['idTransaksi' => $job->id]) }}">
          @csrf
          @method('PUT')

          <div class="row">
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="admin_id">Admin</label>
                <input type="text" id="admin_id" class="form-control" value="{{ $job->admin->name }}"" readonly>
                <input type="text" class="form-control" name="admin_id" value="{{ $job->admin->id }}" hidden required>
              </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="form-group">
                    <label for="">Boss</label>
                    <fieldset class="form-group">
                        <select class="form-select" id="basicSelect" name="boss_id">
                            @foreach ($bosses as $boss)
                                <option {{ $job->boss_id == $boss->id ? 'selected' : '' }} value="{{ $boss->id }}">{{ $boss->name }}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="form-group">
                    <label for="">Start Date</label>
                    <div>
                        <input type="date" id="start_date_update" class="form-control" placeholder="Start Date" name="start_date" required value="{{ $job->start_date }}">
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="payment_date-update">Payment Date</label>
                <input type="date" id="payment_date-update" class="form-control" placeholder="Payment Date" name="payment_date" value="{{ $job->payment_date }}">
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="form-group">
                  <label for="payment_status">Payment Status</label>
                  <div class="form-group">
                      <select class="form-select" id="payment_status" name="payment_status">
                              <option {{ $job->payment_status == 'belum bayar' ? 'selected' : '' }} value="belum bayar">Belum Bayar</option>
                              <option {{ $job->payment_status == 'dibayar' ? 'selected' : '' }} value="dibayar">Dibayar</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="total_payment_update">Total Harga</label>
                <input class="form-control" type="text" id="total_payment_update" name="total_payment" readonly="" value="{{ $job->total_payment }}">
              </div>
            </div>

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
                                  @php $value = 0; @endphp
                                  @foreach ($job_detail as $detail)
                                      @if ($detail->service_id == $service->id)
                                          @php $value += $detail->price; @endphp
                                      @endif
                                  @endforeach
                                  <input type="number" value="{{ $value }}" name="price{{ $service['id'] }}" id="update_price{{ $service->id }}" class="form-control" onchange="hitung()">
                              </td>
                              <td>
                                  @php $keterangan = ""; @endphp
                                  @foreach ($job_detail as $detail)
                                      @if ($detail->service_id == $service->id)
                                          @php $keterangan .= $detail->description; @endphp
                                      @endif
                                  @endforeach
                                  <input type="text" name="description{{ $service->id }}" id="" value="{{ $keterangan }}" class="form-control">
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
          <button type="submit" class="ms-3 btn btn-primary float-end col-2 mt-10" name="simpan">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function hitung() {
  var totalHarga = 0;

  // Hitung total harga
  <?php $i = 0 ?>
  <?php foreach ($services as $service) : ?>
    <?php $idService = $service['id'] ?>
    var inputan = document.getElementById('update_price<?= $idService ?>').value;
    totalHarga += inputan ? parseInt(inputan) : 0;
    <?php $i++ ?>
  <?php endforeach ?>

  // Tambahan logika atau perhitungan lainnya sesuai kebutuhan

  // Tampilkan total harga pada input dengan id total_payment
  document.getElementById('total_payment_update').value = totalHarga;
}



</script>