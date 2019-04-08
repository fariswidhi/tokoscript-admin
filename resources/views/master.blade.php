<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.6
 * @link http://coreui.io
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
  <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
  <title>CoreUI - Open Source Bootstrap Admin Template</title>

  <!-- Icons -->
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <!-- Styles required by this views -->
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">  
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<!-- BODY options, add following classes to body to change options
'.header-fixed' - Fixed Header
'.brand-minimized' - Minimized brand (Only symbol)
'.sidebar-fixed' - Fixed Sidebar
'.sidebar-hidden' - Hidden Sidebar
'.sidebar-off-canvas' - Off Canvas Sidebar
'.sidebar-minimized'- Minimized Sidebar (Only icons)
'.sidebar-compact'    - Compact Sidebar
'.aside-menu-fixed' - Fixed Aside Menu
'.aside-menu-hidden'- Hidden Aside Menu
'.aside-menu-off-canvas' - Off Canvas Aside Menu
'.breadcrumb-fixed'- Fixed Breadcrumb
'.footer-fixed'- Fixed footer
-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  @include('panel.navbar')
  
  <div class="app-body">
    @include('panel.sidebar')
    <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      @include('panel.breadcrumb')

      @yield('content')
      <!-- /.container-fluid -->
    </main>

    @include('panel.asidemenu')

  </div>

  @include('panel.footer')

  @include('panel.scripts')
  @yield('myscript')
  @stack('scripts')


  <!-- Modal -->
<div id="modalEdit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title mdl-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <div class="modal-body">
        <div id="mdlBody">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript" src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor//bootstrap-notify.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor//bootstrap-notify.min.js') }}"></script>

  <script type="text/javascript">
    

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});    

    $(".select2").select2();
                        $(document).on('click','.btn-show-modal',function(){
                            var source = $(this).attr('data-source');
                            var title = $(this).attr("data-title");
                            $.get(source,function(res){
                                  $(".select2").select2({
                                    width:'100%'
                                  });
                              $(document).ready(function(){
                            var form = $("#form");
                            // form.validate();

//                             jQuery.extend(jQuery.validator.messages, {
//     required: "Harap isi bidang ini",
//     remote: "Please fix this field.",
//     email: "Masukan email yang benar",
//     url: "Please enter a valid URL.",
//     date: "Please enter a valid date.",
//     dateISO: "Please enter a valid date (ISO).",
//     number: "Please enter a valid number.",
//     digits: "Please enter only digits.",
//     creditcard: "Please enter a valid credit card number.",
//     equalTo: "Please enter the same value again.",
//     accept: "Please enter a value with a valid extension.",
//     maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
//     minlength: jQuery.validator.format("Please enter at least {0} characters."),
//     rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
//     range: jQuery.validator.format("Please enter a value between {0} and {1}."),
//     max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
//     min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
// });


    // form.validate();

  });


                            $("#modalEdit").modal('show')

                            $(".mdl-title").text(title);
                              $("#mdlBody").html(res);


    $(".select2").select2();
    // $('.datepicker').datepicker({
    //   autoclose: true,
    //   dateFormat: 'yy-mm-dd'
    // });
                            })

                        }) ;


@if (Request::segment(1)=='produk' || Request::segment(1)=='metode-pembayaran')
  {{-- expr --}}

$(document).on('click','.btn-save',function(){
  var form = $("#form");

  var action = form.attr('action');
 


// if(form.valid()){

   $(this).attr('disabled','disabled');
  $(this).html('<i class="fa fa-circle-o-notch fa-spin  fa-fw"></i><span class="sr-only">Loading...</span> Menyimpan');

  var method= $("#form input[name='_method']").val();

 // var form = $(this);
    var formdata = false;
    if (window.FormData){
        formdata = new FormData(form[0]);
    }

    $.ajax({
    url: action,
    method: method,
    dataType: "JSON",
    data        : formdata ? formdata : form.serialize(),
    cache       : false,
    contentType : false,
    processData : false,
    success:function(res){

      if(res.status==1){
        $(".btn-save").html('<i class="fa fa-check"></i> Tersimpan');
        $(".btn-save").addClass('btn-success');        
      }
      else{
        $(".btn-save").html('<i class="fa fa-times"></i> Gagal Tersimpan');
        $(".btn-save").addClass('btn-danger');
      }


        $(".btn-save").removeAttr('disabled');
        location.reload();
      //   setTimeout(function(){

      // },2000)
    }
  });
// }
});



@else


@if (Request::segment(1)=='user-system')
  {{-- expr --}}


$(document).on('click','.btn-save',function(){
  var form = $("#form");
  var action = form.attr('action');
 

// alert("a");


   $(this).attr('disabled','disabled');
  $(this).html('<i class="fa fa-circle-o-notch fa-spin  fa-fw"></i><span class="sr-only">Loading...</span> Menyimpan');

  var method= $("#form input[name='_method']").val();

// console.log(method);


    $.ajax({
    url: action,
    method: method,
    dataType: "JSON",
    data:form.serialize(),
    success:function(res){

      if(res.status==1){
        $(".btn-save").html('<i class="fa fa-check"></i> Tersimpan');
        $(".btn-save").addClass('btn-success');        
        location.reload();
      }
      else{


         $.notify({
  // options
  message: res.msg
},{
  // settings
  type: 'success',
  z_index: 20000
});



        $(".btn-save").html('<i class="fa fa-times"></i> Gagal Tersimpan');
        $(".btn-save").addClass('btn-danger');
        setTimeout(function(){
          $(".btn-save").removeAttr('disabled');
              $(".btn-save").html(' Simpan');
                      $(".btn-save").removeClass('btn-danger');
                      $(".btn-save").addClass('btn-primary');


        },500);
      }


        // $(".btn-save").removeAttr('disabled');
        // location.reload();
      //   setTimeout(function(){

      // },2000)
    }
  });




  // console.log(action);


  // alert(action);

});



  @else


$(document).on('click','.btn-save',function(){
  var form = $("#form");
  var action = form.attr('action');
 

// alert("a");


   $(this).attr('disabled','disabled');
  $(this).html('<i class="fa fa-circle-o-notch fa-spin  fa-fw"></i><span class="sr-only">Loading...</span> Menyimpan');

  var method= $("#form input[name='_method']").val();

// console.log(method);


    $.ajax({
    url: action,
    method: method,
    dataType: "JSON",
    data:form.serialize(),
    success:function(res){

      if(res.status==1){
        $(".btn-save").html('<i class="fa fa-check"></i> Tersimpan');
        $(".btn-save").addClass('btn-success');        
      }
      else{
        $(".btn-save").html('<i class="fa fa-times"></i> Gagal Tersimpan');
        $(".btn-save").addClass('btn-danger');
      }


        $(".btn-save").removeAttr('disabled');
        location.reload();
      //   setTimeout(function(){

      // },2000)
    }
  });




  // console.log(action);


  // alert(action);

});


@endif
@endif

  $(document).on('click','.btn-remove-data',function(){
    var id = $(this).attr('data-id');
    var url = $(this).attr('data-action');
    if(confirm("Apakah Anda Akan Menghapus Data Ini? Data Ini dan Perintah Kerja didalamnya Akan Terhapus")){
      $.ajax({
        url:url,
        method: "DELETE",
        dataType: "JSON",
        success:function(res){
          // $("."+id).remove();

          if(res.response=="1"){
            alert("Data Berhasil Dihapus");
          $("."+id).remove();    
          console.log(id);

          }
        }
      })
    }
  });

  </script>

</body>
</html>