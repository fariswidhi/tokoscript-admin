@extends('master')
@section('content')
        <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="row">

            <div class="col-md-12">

              <div class="card">
                <div class="card-header">
                  <strong>Detail Transaksi</strong>
                </div>
                <div class="card-body">
                  <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->

                  @if ($table->count()>0)

                  @php
                    $data= $table->first();
                  @endphp
                    <div class="row">
                      <div class="col-lg-6">
                        <h3>Detail Transaksi</h3>
                        <table class="table table-striped">
                          <tr>
                            <td>ID</td><td>{{$data->transaction_id}}</td>
                          </tr>
                          <tr>
                            <td>User</td><td>{{!empty($data->user)? $data->user->nama:''}}</td>
                          </tr>
                          <tr>
                            <td>Status</td><td>{!!$data->status_pembayaran == '1' ? '<span class="badge badge-success">Dibayar</span>':"<span class='badge badge-danger'>Belum Dibayar</span>"!!}</td>
                          </tr>
                          <tr>
                            <td>Waktu</td><td>{{date('d-M-Y H:i:s',strtotime($data->created_at))}}</td>
                          </tr>
                          <tr>
                            <td>Metode Pembayaran</td><td>{{!empty($data->metodePembayaran)?$data->metodePembayaran->metode_pembayaran:''}}</td>
                          </tr>
                          <tr>
                            <td>Total</td><td>{{number_format($data->transaksi_total,0,'.','.')}}</td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-lg-6">
                        <h3>Mutasi</h3>
                        @if ($mutasi->count()>0)
                          {{-- expr --}}
                          @php
                            $mutasi = $mutasi->first();
                          @endphp
                        <table class="table table-striped">
                          <tr>
                            <td>Service Code</td><td>{{$mutasi->service_code}}</td>
                          </tr>  
                          <tr>
                            <td>Dibayar Pada</td><td>{{date('d-M-Y H:i:s',strtotime($mutasi->payment_at))}}</td>
                          </tr>  
                          <tr>
                            <td>Description</td><td>{{$mutasi->description}}</td>
                          </tr>
                        </table>
                        @else
                        <center><h3>Tidak Ada Mutasi</h3></center>
                        @endif

                      </div>
                      <div class="col-lg-12"> 
                        <table class="table table-striped">
                          <thead>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                          </thead>
                          <tbody>
                            @if ($detail->count()>0)
                              {{-- expr --}}
                              @php
                                $no=1;
                              @endphp
                              @foreach ($detail->get() as $d)
                                {{-- expr --}}

                                <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$d->product->nama}}</td>
                                  <td>{{$d->harga}}</td>
                                </tr>
                              @endforeach
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                    {{-- expr --}}
                  @endif
                      
                </div>
              </div>

            </div>
            <!--/.col-->

      
            <!--/.col-->
          </div>
          <!--/.row-->
        </div>

      </div>

@endsection