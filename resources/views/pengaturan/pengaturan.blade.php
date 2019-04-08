@extends('master')
@section('content')
        <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="row">

            <div class="col-md-12">

              <div class="card">
                <div class="card-header">
                  <strong>Pengaturan</strong>
                </div>
                <div class="card-body">
                  <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->

                  <div class="row">
                    <div class="col-lg-6">
                      <form action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                          <label>Nama Web</label><br>
                          <input type="text" name="nama_web" class="form-control" value="{{$data->nama_web}}">
                        </div>
                        <div class="form-group">
                          <label>Logo</label><br>
                          <img src="{{ url($data->logo_web) }}" style="width: 100px;">
                          <input type="file" name="logo" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Komisi Kontributor(%)</label><br>
                          <input type="text" name="komisi" class="form-control" value="{{$data->komisi}}">
                        </div>
                         <button class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <div class="col-lg-6">
                      
                    </div>
                  </div>
               

           

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


