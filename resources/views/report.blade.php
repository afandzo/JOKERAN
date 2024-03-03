@extends('layouts.main')

{{-- TITLE --}}
@section('title')
  Report
@endsection

{{-- CARD HEADER --}}
@section('card_header')
  Report
@endsection

{{-- CONTENT --}}
@section('content')
<div class="row mb-3">
  <div class="col-12">
      <div class="card">
          <form action="/laporan-transaksi/cari" method="post">
              @csrf
              <div class="card-content">
                  <div class="col-12">
                      <div class="row p-4">
                          <div class="col-4">
                              <input type="date" class="form-control" name="awal" value="{{ @$awal }}">
                          </div>
                          <div class="col-4">
                              <input type="date" class="form-control" name="akhir" value="{{ @$akhir }}">
                          </div>
                          <div class="col-3">
                              <button type="submit" class="btn btn-secondary" name="cari">Tampilkan</button>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>
</div>

{{-- Check if data is available --}}
@if (@$coba)
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
            {{-- Add the print button --}}
            <div class="card-footer d-flex justify-content-between">
                <a href="/laporan-transaksi/cetak?awal={{ $awal }}&akhir={{ $akhir }}"><button class="btn btn-danger" type="button">PRINT</button></a>
            </div>
        </div>
    </div>
    @endif
    {{-- Show error message if no data is found --}}
    @if (@$error)
    <div class="alert alert-warning"><i class="bi bi-exclamation-triangle"></i>Tidak ada data transaksi yang ditemukan</div>
    @endif
</div>



@endsection
