@extends('master')
@section('content')
        <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="row">

            <div class="col-md-12">

              <div class="card">
                <div class="card-header">
                  <strong>Transaksi</strong>
                </div>
                <div class="card-body">
                  <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
               

     @php

          // echo '<button class="btn btn-show-modal btn-primary role-tambah" data-title="Tambah Data" data-source="'.url(Request::segment(1)).'/create">Tambah Data</button>';
         @endphp

         


              <table class="table table-striped">
                <thead>
                  <th>#</th>
                  <th>User</th>
                  <th>Status</th>
                  <th>Total</th>
                  <th>Opsi</th>
                </thead>
                <tbody>

                  @foreach ($dataTable as $d)
                    {{-- expr --}}
                    <tr>
                      <td>{{$d->transaction_id}}</td>
                       <td>{{!empty($d->user) ? $d->user->nama : ''}}</td>
                       <td>{!!$d->status_pembayaran == '1' ? '<span class="badge badge-success">Dibayar</span>':"<span class='badge badge-danger'>Belum Dibayar</span>"!!}</td>
                       <td>{{number_format($d->transaksi_total,0,'.','.')}}</td>
                       <td><a class="btn btn-primary" href="{{ url('transaksi/'.$d->transaction_id) }}"><i class="fa fa-info"></i></a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>



              <center>              {{$dataTable->appends(['q'=>Request::get('q')])->links()}}</center>
           

           

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