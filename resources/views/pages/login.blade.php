<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

    <title>CoreUI Bootstrap 4 Admin Template</title>

    <!-- Icons -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Styles required by this views -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
</head>

<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h1>Login</h1>
                        <p class="text-muted">Sign In to your account</p>
                        <form method="POST" action="{{ url()->current() }}" id="form">

                            {{ csrf_field() }}
                            <div class="input-group mb-3">
                                <span class="input-group-addon"><i class="icon-user"></i></span>
                                <input type="text" name="username" value="{{ old('email') }}" class="form-control" required
                                       autofocus placeholder="email">
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-addon"><i class="icon-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                       required>
                            </div>
                        
                        </form>

                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary px-4 submit">Login</button>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-link px-0 ">Forgot password?</button>
                                </div>
                            </div>
                    </div>
                </div>
            {{--     <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <div>
                            <h2>Sign up</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.</p>

                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap and necessary plugins -->
<script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor//bootstrap-notify.min.js') }}"></script>

<script type="text/javascript">
    
$(document).on("click",".submit",function(){
    var form = $("#form").serialize();

    $.ajax({
        url: $("#form").attr('action'),
        method: $("#form").attr('method'),
        data: form,
        dataType: "JSON",
        success: function(res){
            // console.log(res);
            if (res.status==1) {

                      $.notify({
  // options
  message: res.msg
},{
  // settings
  type: 'success'
});
                setTimeout(function(){
                    location.reload();
                },1000);
            }
            else{
                  $.notify({
  // options
  message: res.msg
},{
  // settings
  type: 'danger'
});
            }
        }
    })
})
</script>
</body>
</html>