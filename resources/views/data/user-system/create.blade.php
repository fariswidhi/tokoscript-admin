                <div class="row" style="margin-left: 0;margin-right: 0;">
                  <div class="col-lg-12">    
                  <form action="{{url(Request::segment(1))}}" method="post" id="form">
  
                {{csrf_field()}}
                {{method_field('POST')}}
                @foreach ($data as $d)
                  {{-- expr --}}
                    <div class="form-group">
                      <label>{{$d['name']}}</label><br>

                      @if ($d['type']=='text' || $d['type']=='date'|| $d['type']=='number' || $d['type']=='password'|| $d['type']=='email')
                        {{-- expr --}}
                        <input type="{{$d['type']}}" name="{{$d['field']}}" class="form-control {{$d['class']}}" required>
                      @elseif($d['type']=='textarea')
                      <textarea required class="form-control" name="{{$d['field']}}"></textarea>
                      @elseif($d['type']=='select')

                      @php
                        $id = $d['id'];
                        $value = $d['value'];
                      @endphp
{{--                           {{$d['data']}} --}}
                        <select required class="form-control {{$d['class']}}" name="{{$d['field']}}">
                          <option value="">Pilih Data</option>
                          @foreach ($d['data'] as $selectData)
                          <option value="{{$selectData->$id}}">{{$selectData->$value}}</option>
                            {{-- expr --}}
                          @endforeach
                        </select>
                      @endif
                    </div>
                @endforeach


                <button type="button" class="btn btn-primary btn-save">Simpan</button>
                </div>
                </div>
