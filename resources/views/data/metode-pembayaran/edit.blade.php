
              <form action="{{url(Request::segment(1).'/'.Request::segment(2))}}" method="post" id="form" enctype="multipart/form-data">
                <div class="row" style="margin-left: 0;margin-right: 0;">
                  <div class="col-lg-12">      
                {{csrf_field()}}
                {{method_field('POST')}}
                @foreach ($data as $d)
                  {{-- expr --}}
                    <div class="form-group">
                      <label>{{$d['name']}}</label><br>
                        @php
                          $field = $d['field'];
                        @endphp
                      @if ($d['type']=='text' || $d['type']=='date'|| $d['type']=='number' || $d['type']=='password'|| $d['type']=='email')
                        {{-- expr --}}
                        <input required type="{{$d['type']}}" name="{{$d['field']}}" class="form-control {{$d['class']}}" value="{{$table->$field}}">

                      @elseif ($d['type']=='file')
                        {{-- expr --}}

{{--                         @php
                        print_r($field);
                        @endphp --}}

@if ($d['field']=='foto')
                        <img src="" style="width: 100px;height: 100px;display: none;" class="imgne-preview">
                        @if(!empty($table->$field))


                        <img src="{{url($table->$field)}}" style="width: 100px;height: 100px;" class="imgne-preview">
                        @else
                        <img src="" style="width: 100px;height: 100px;" class="imgne-preview">

                        @endif

                        @else

@endif

                        <input type="{{$d['type']}}" name="{{$d['field']}}" class="form-control {{$d['class']}}" >
<br>
                        <a href="{{ url($table->$field) }}" class="btn btn-primary">Download</a>

                        @elseif($d['type']=='textarea')
                      <textarea id="summernote" required class="form-control" name="{{$d['field']}}">{{$table->$field}}</textarea>
                      @elseif($d['type']=='select')

                      @php
                        $id = $d['id'];
                        $value = $d['value'];
                      @endphp
                                @if($d['field']=='tags')
 <select required class="form-control select2 {{$d['class']}}" name="{{$d['field']}}[]"  multiple>
                          <option value="">Pilih Data</option>
                          @foreach ($d['data'] as $selectData)

                          @php
                          if ($arr!=null) {
                              // print_r($arr);
// echo $arr;
                            $selected = in_array($selectData->id, $arr) ? 'selected':'';
                          }
                          else{
                            $selected = '';
                          }
                          // echo "string";
                          // print_r($selected);
                          @endphp
                          <option {{$selected}} value="{{$selectData->$id}}">{{$selectData->$value}}</option>

                          @endforeach
                        </select>

                        @else
                         <select  class="form-control {{$d['class']}} select2" name="{{$d['field']}}" style="width: 50%;">
                          <option value="">Pilih Data</option>
                          @foreach ($d['data'] as $selectData)
                          <option {{ $table->$field == $selectData->$id ? 'selected':''}}  value="{{$selectData->$id}}">{{$selectData->$value}}</option>
                            {{-- expr --}}
                          @endforeach
                        </select>
                       @endif
                      @endif
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary btn-save">Ubah</button>
                </div>
                </div>

              </form>