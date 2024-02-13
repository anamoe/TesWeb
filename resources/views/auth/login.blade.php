<!DOCTYPE html>
<html>

<head>
      <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Masuk </title>

    <link href="{{asset('public/css/ruang-admin/ruang-admin.min.css')}} rel=" stylesheet">
    <link href="{{asset('public/ruang-admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/ruang-admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<!-- 
<link rel="stylesheet" type="text/css" href="{{asset('public/ruang-admin/ruang-admin.min.css')}}"> -->
<style>
    body {
        background-color: #b7dde1;
        -webkit-animation: color 12s ease-in 0s infinite alternate running;
        -moz-animation: color 12s linear 0s infinite alternate running;
        animation: color 12s linear 0s infinite alternate running;
    }

    @-webkit-keyframes color {
        0% {
            background-color: #b7dde1;
        }

        25% {
            background-color: #b7dde1;
        }

        50% {
            background-color: #b7dde1;
        }

        75% {
            background-color: #91aec4;
        }

        100% {
            background-color: #5f84a2;
        }
    }
    }
</style>

<body>

@if(session()->has('message'))
    <div class="notif col-10 col-xs-11 col-sm-4 alert alert-success d-block" role="alert" id="notif">
        <button type="button" class="close" onclick="document.getElementById('notif').classList.remove('d-block')">×</button>
        <span data-notify="icon" class="fa fa-bell"></span>
        <span data-notify="title">Success</span> <br>
        <span data-notify="message">Berhasil Mendaftar</span>
    </div>
    @endif
    @if(session()->has('error'))
    <div  class="notif col-10 col-xs-11 col-sm-4 alert alert-danger d-block" role="alert" id="notif">
        <button type="button" class="close" onclick="document.getElementById('notif').classList.remove('d-block')">×</button>
        <span data-notify="icon" class="fa fa-bell"></span> 
        <span data-notify="title">Gagal</span> <br>
        <span data-notify="message">{{session()->get('error')}}</span>
    </div>
    @endif
    <section class="ftco-section">
        <div class="container">
           
            <div class="row justify-content-center">
                <div class="col-md-5 col-lg-7">
                    <div class="card shadow-sm my-4">
                   
                        <div class="login-wrap p-4 p-md-5">
                           
                            <h3 class="text-center mb-4">Masuk</h3>
                            <form action="{{ route('logins') }}" method="post" class="login-form">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control rounded-left" placeholder="Email" required>
                                </div>
                                <div class="form-group d-flex">
                                    <input type="password" name="password" class="form-control rounded-left" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Masuk</button>
                                </div>
                               
                            </form>

        

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




</body>

<script>


</script>

</html>