
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
  
                      if ($field=='foto') {
                                              # code...
                                                            echo "<img style='width:100px;height:100px' src='".$table->$field."'>";


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
