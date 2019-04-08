
              <form action="{{url(Request::segment(1).'/'.Request::segment(2))}}" method="post" id="form">
                <div class="row" style="margin-left: 0;margin-right: 0;">
                  <div class="col-lg-12">      
                {{csrf_field()}}
                {{method_field('PUT')}}
                @foreach ($data as $d)
                  {{-- expr --}}
                    <div class="form-group">
                      <label>{{$d['name']}}</label><br>
                        @php
                          $field = $d['field'];
                        @endphp
                      @if ($d['type']=='text' || $d['type']=='date'|| $d['type']=='number' || $d['type']=='password'|| $d['type']=='email')
                        {{-- expr --}}

                        @if ($d['type']=='password')
                          {{-- expr --}}
                           <input required type="{{$d['type']}}" name="{{$d['field']}}" class="form-control {{$d['class']}}" >


                           @else
                             <input required type="{{$d['type']}}" name="{{$d['field']}}" class="form-control {{$d['class']}}" value="{{$table->$field}}">

                        @endif

                                              @elseif($d['type']=='textarea')
                      <textarea required class="form-control" name="{{$d['field']}}">{{$table->$field}}</textarea>
                      @elseif($d['type']=='select')

                      @php
                        $id = $d['id'];
                        $value = $d['value'];
                      @endphp
{{--                           {{$d['data']}} --}}
                        <select class="form-control {{$d['class']}}" name="{{$d['field']}}" required>
                          <option value="">Pilih Data</option>
                          @foreach ($d['data'] as $selectData)
                          <option {{ $table->$field == $selectData->$id ? 'selected':''}} value="{{$selectData->$id}}">{{$selectData->$value}}</option>
                            {{-- expr --}}
                          @endforeach
                        </select>
                      @endif
                    </div>
                @endforeach
                <button type="button" class="btn btn-primary btn-save">Simpan</button>
                </div>
                </div>

              </form>
           