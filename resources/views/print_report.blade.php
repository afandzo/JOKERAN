<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
  <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg') }}" type="image/x-icon" />
  <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png" />
  <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
  <title>Cetak Laporan</title>
</head>
<body onload="window.print();">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header py-3">
        <div class="row">
          <div class="col-sm-2 float-left">
            <img src="../assets/images/logo/logo2.png" width="75px" alt="brand">
          </div>
          <div class="col-sm-10 float-left">
            <h3>ARA DECORATION</h3>
            <h6>Jl. Jalanin aja dulu, Kel. Kebak, Kec. Jumantono, Kabupaten Karanganyar, Telp 0812-1591-2946</h6>
            <h6>@aradecoration</h6>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-12">
            <div class="card p-4">
              <div class="card-content">
                <div class="table-responsive">
                  <table class="table mb-3" id="table1">
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Invoice Code</th>
                      <th>Boss</th>
                      <th>Service</th>
                      <th>Total</th>
                      <!-- Add more headers as needed -->
                  </tr>
                  @php
                      $no = 1;
                      $i = 0;
                      $totalHarga = 0;
                  @endphp

                  @foreach ($jobs as $job)
                  <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $job->start_date }}</td>
                      <td>{{ $job->invoice_code }}</td>
                      <td>{{ $job->boss->name }}</td>
                      <td>
                          <ul class="list-group">
                              @if ($job->details)
                                  @foreach ($job->details as $detail)
                                      <li class="list-group-item">{{ $detail->service->service_name }} ({{ $detail->price }})</li>
                                  @endforeach
                              @endif
                          </ul>
                      </td>
                      <td>
                          @if(isset($bayar[$i]))
                              Rp. {{ $bayar[$i] }}
                              @php $totalHarga += $bayar[$i]; @endphp
                          @else
                              {{-- Handle the case when $bayar[$i] is not set --}}
                          @endif
                      </td>
                  </tr>
                  @php $i++; @endphp
                  @endforeach


                  <tr>
                      <td colspan="5">Total</td>
                      <td>Rp. {{ $totalHarga }}</td>
                  </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>
  <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
  <script src="{{ asset('assets/js/pages/form-element-select.js') }}"></script>    
</body>
</html>