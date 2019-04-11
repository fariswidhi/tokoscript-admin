  <form action="{{url(Request::segment(1))}}" method="post" id="form" enctype="multipart/form-data">
                <div class="row" style="margin-left: 0;margin-right: 0;">
                  <div class="col-lg-12">      
                {{csrf_field()}}
                {{method_field('POST')}}
                @foreach ($data as $d)
                  {{-- expr --}}
                    <div class="form-group">
                      <label>{{$d['name']}}</label><br>

                      @if ($d['type']=='text' || $d['type']=='date'|| $d['type']=='number' || $d['type']=='password'|| $d['type']=='email')


                        {{-- expr --}}
                        @if($d['field']=='harga')
                        <input type="{{$d['type']}}" name="{{$d['field']}}" class="form-control {{$d['class']}}" required style="font-size: 20px;width: 100%;">

                        @else
                        <input type="{{$d['type']}}" name="{{$d['field']}}" class="form-control {{$d['class']}}" required style="width: 100%;">

                        @endif
                      @elseif ($d['type']=='file')
                        {{-- expr --}}

{{--                    {{$d['field']}} --}}

@if ($d['field']=='foto')
                        <img src="" style="width: 100px;height: 100px;display: none;" class="imgne-preview">
@endif
                        <input type="{{$d['type']}}" name="{{$d['field']}}" class="form-control {{$d['class']}}" style="width: 100%;">
                      @elseif($d['type']=='textarea')


                      <textarea id="summernote" required class="form-control" name="{{$d['field']}}"></textarea>
                      @elseif($d['type']=='select')

                      @php
                        $id = $d['id'];
                        $value = $d['value'];
                      @endphp
{{--                           {{$d['data']}} --}}
                       

                       @if($d['field']=='tags')
 <select required class="form-control select2 {{$d['class']}}" name="{{$d['field']}}[]"  multiple style="width: 100%;">
                          <option value="">Pilih Data</option>
                          @foreach ($d['data'] as $selectData)
                          <option value="{{$selectData->$id}}">{{$selectData->$value}}</option>
                            {{-- expr --}}
                          @endforeach
                        </select>

                        @else
                         <select  class="form-control {{$d['class']}} select2" name="{{$d['field']}}" style="width: 100%;">
                          <option value="">Pilih Data</option>
                          @foreach ($d['data'] as $selectData)
                          <option value="{{$selectData->$id}}">{{$selectData->$value}}</option>
                            {{-- expr --}}
                          @endforeach
                        </select>
                       @endif
                      @endif
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                </div>
                </div>


            </form>

            <script type="text/javascript">
                        
  $(document).ready(function() {
  $('#summernote').summernote({
    height:400
  });
});
  function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('.imgne-preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$(".imgne").change(function() {
  $(".imgne-preview").show();
  readURL(this);
});

$(".select2").select2({
  tags:true
});
</script>