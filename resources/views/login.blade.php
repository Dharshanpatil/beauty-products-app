<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- Page Title -->
    <title>Admin login</title>
    <!-- Meta Data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <!-- Favicon -->
    <!-- Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet"/>

    <!-- ======= BEGIN GLOBAL MANDATORY STYLES ======= -->
    <link href="{{asset('public/assets')}}/css/material-icons.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('public/assets')}}/css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="{{asset('public/assets')}}/plugins/perfect-scrollbar/perfect-scrollbar.min.css"/>
    <!-- ======= END BEGIN GLOBAL MANDATORY STYLES ======= -->

    <!-- ======= MAIN STYLES ======= -->
    <link rel="stylesheet" href="{{asset('public/assets')}}/css/style.css"/>
    <!-- ======= END MAIN STYLES ======= -->
    <link rel="stylesheet" href="{{asset('public/assets')}}/css/toastr.css">
</head>

<body>
<!-- Preloader -->
<div class="preloader"></div>
<!-- End Preloader -->

<!-- Login Form -->
<div class="login-form dark-support" data-bg-img="{{asset('public/assets')}}/img/media/login-bg.png">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <form action="{{route('auth.login')}}" enctype="multipart/form-data" method="POST"
                      id="login-form">
                    @csrf
                    <div class="card my-5 ov-hidden">
                        <div class="login-wrap">
                            <div class="login-left">
                                <img class="login-img"
                                     src="{{asset('public/assets')}}/img/media/login-img.png"
                                     alt="">
                            </div>
                            <div class="login-right-wrap">
                              
                                <div class="login-right">
                                    <div class="text-center mb-30">
                                        <img class="login-img login-logo mb-2"
                                             src="{{asset('storage/app/public/business')}}/"
                                             onerror="this.src='{{asset('public/assets')}}/img/media/upload-file.png'"
                                             alt="">
                                        <h5 class="text-uppercase c1 mb-3">Beauty</h5>
                                        <h2 class="mb-1">Sign in</h2>
                                    </div>

                                    <div class="mb-3">
                                        <div class="mb-30">
                                            <div class="form-floating">
                                                <input type="email" name="email_or_phone" class="form-control"
                                                       placeholder="email" required="" id="email">
                                                <label>Email</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="password" name="password" class="form-control"
                                                       placeholder="password" required=""
                                                       id="password">
                                                <label>Password</label>
                                                <span class="material-icons togglePassword">visibility_off</span>
                                            </div>
                                        </div>
                                        
                                    </div>

                                

                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn--primary radius-50 text-uppercase"
                                                type="submit">sign in</button>
                                    </div>
                                </div>

       
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Login Form -->

<!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->
<script src="{{asset('public/assets')}}/js/jquery-3.6.0.min.js"></script>
<script src="{{asset('public/assets')}}/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('public/assets')}}/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{asset('public/assets')}}/js/main.js"></script>
<!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->

{{--toastr and sweetalert--}}
<script src="{{asset('public/assets')}}/js/sweet_alert.js"></script>
<script src="{{asset('public/assets')}}/js/toastr.js"></script>
{!! Toastr::message() !!}

@if(env('APP_ENV')=='demo')
    <script>
        function copy_cred() {
            $('#email').val('admin@admin.com');
            $('#password').val('12345678');
            toastr.success('Copied successfully!', 'Success!', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>
@endif


@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif
</body>
</html>
