@extends('master')
@section('content')
        <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="row">

            <div class="col-md-12">

              <div class="card">
                <div class="card-header">
                  <strong>Akun Bank</strong>
                </div>
                <div class="card-body">
                  <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
               

     @php

          echo '<button class="btn btn-show-modal btn-primary role-tambah" data-title="Tambah Data" data-source="'.url(Request::segment(1)).'/create">Tambah Data</button>';
         @endphp


              <table class="table table-striped">
                <thead>
                  @foreach ($data as $d)
                    {{-- expr --}}
                    @if ($d['showAsTable'])
                    <th>{{$d['name']}}</th>
                    @endif
                  @endforeach
                  <th>Opsi</th>
                </thead>
                <tbody>
                  @foreach ($dataTable as $dt)
                    {{-- expr --}}
                    <tr class="data-{{$dt->id}}">
                  @foreach ($data as $td)
                    {{-- expr --}}
                    @if ($td['showAsTable'])
                    <td>
                    @php
                    $obj = $td['field'];

                    $related = $td['related'];
                    $belongsTo = $td['belongsTo'];
                    $key = $td['key'];
                    // print_r($belongsTo);
                    if ($related){
                      // JIKA ADA DATA YANG JOIN
                      if(!empty($dt->$belongsTo)){
                      echo $dt->$belongsTo->$key;

                      }
                      else{
                        // echo "string";
                        // print_r($belongsTo);

                        print_r($dt->$belongsTo);
                      }
                    }

                    else{
                      echo $dt->$obj;

                    }

                    // echo $belongsTo;
                    @endphp
                    </td>
                    @endif
                  
                  @endforeach
  <td>


    @php
    echo '<button class="btn btn-show-modal btn-info btn-xs role-info" data-title="Info" data-source="'.url(Request::segment(1).'/'.$dt->id).'">Info</button> ';

          echo '<button class="btn btn-show-modal btn-success btn-xs role-ubah" data-title="Edit Data" data-source="'.url(Request::segment(1).'/'.$dt->id.'/edit').'">Edit</button>';

echo ' <button data-id="data-'.$dt->id.'" data-action="'.url(Request::segment(1).'/'.$dt->id).'"  class="btn btn-danger btn-xs btn-remove-data role-hapus">Hapus</button>';
                  @endphp

                    </td>
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


