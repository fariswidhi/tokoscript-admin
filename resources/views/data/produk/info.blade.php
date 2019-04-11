
              <form action="{{url(Request::segment(1).'/'.Request::segment(2))}}" method="post">
                <div class="row" style="margin-left: 0;margin-right: 0;">
                  <div class="col-lg-6">      
                {{csrf_field()}}
                {{method_field('PUT')}}
                @foreach ($data as $d)
                  {{-- expr --}}
                    <div class="form-group">
                      <label>{{$d['name']}}</label><br>
                        {{-- expr --}}
                        @php
                          $field = $d['field'];
                          $related = $d['related'];
                          $belongsTo = $d['belongsTo'];
                          $key = $d['key'];
                    // print_r($belongsTo);
                          if ($related){
                      // JIKA ADA DATA YANG JOIN
                            echo $table->$belongsTo->$key;
                          }

                    else{


                      if($d['type']=='file'){
                        if ($d['field']=='foto'){
                          echo '                        <img src="" style="width: 100px;height: 100px;display: none;" class="imgne-preview">';

                              if(!empty($table->$field)){
                                echo '                        <img src="'.url($table->$field).'" style="width: 100px;height: 100px;" class="imgne-preview">';
                              }

                        }
                        else{
                          echo '                        <a href="'.url($table->$field).'" class="btn btn-primary">Download</a>';
}
                        }
                        else{
                                                                    echo $table->$field;

                        }
                    }

                        @endphp
{{--                         {{$table->$field}} --}}
                    
                    </div>
                @endforeach

                </div>
                </div>

              </form>

{{--           @elseif ($d['type']=='file') --}}
                        {{-- expr --}}

{{--                         @php
                        print_r($field);
                        @endphp --}}

{{-- @if ($d['field']=='foto')
                        <img src="" style="width: 100px;height: 100px;display: none;" class="imgne-preview">
                        @if(!empty($table->$field))


                        <img src="{{url($table->$field)}}" style="width: 100px;height: 100px;" class="imgne-preview">
                        @else
                        <img src="" style="width: 100px;height: 100px;" class="imgne-preview">

                        @endif

                        @else

@endif --}}