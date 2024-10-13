<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <title>{{ __('login.login') }}</title>
    <!-- Custom CSS -->
    <link href="../../dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(../../assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="../../assets/images/logo-icon.png" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">{{ __('login.sign_in') }}</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" id="loginform" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" name="email" class="form-control form-control-lg" placeholder="{{ __('login.email') }}" aria-label="Username" aria-describedby="basic-addon1">
                                    @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="password" placeholder="{{ __('login.password') }}" aria-label="Password" aria-describedby="basic-addon1">
                                    @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            {{-- <label class="custom-control-label" for="customCheck1">Remember me</label> --}}
                                            <a href="javascript:void(0)" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> {{ __('login.forgot') }}</a>
                                            {{-- <a href="{{ route('register-page') }}" class="custom-control-label">{{ __('login.register') }}</a> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">{{ __('login.login') }}</button>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                        <div class="social">
                                            <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="" data-original-title="Login with Facebook"> <i aria-hidden="true" class="fab  fa-facebook"></i> </a>
                                            <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="" data-original-title="Login with Google"> <i aria-hidden="true" class="fab  fa-google-plus"></i> </a>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        {{ __('login.dont_have_an_account') }}<a href="{{ route('register-page') }}" class="text-info m-l-5"><b>{{ __('login.sign_up') }}</b></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- <div id="recoverform">
                    <div class="logo">
                        <span class="db"><img src="../../assets/images/logo-icon.png" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Recover Password</h5>
                        <span>Enter your Email and instructions will be sent to you!</span>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->
                        <form class="col-12" action="index.html">
                            <!-- email -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control form-control-lg" type="email" required="" placeholder="Username">
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-block btn-lg btn-danger" type="submit" name="action">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    </script>
{{-- <body>
    <div class="form-container" >
        <form action="{{ route('login') }}" method="POST" style="width:500px">
            @csrf

            <div class="from-group">
                <label for="email">البريد الالكتروني : </label><br>
                <input class="form-control" type="email" id="email" name="email"><br><br>
            </div>
            <div class="from-group">
                <label for="name">كلمة المرور :</label><br>
                <input class="form-control" type="password" id="name" name="password"><br><br>
            </div>


            <button class="btn btn-primary" type="submit" value="Submit">تسجيل دخول</button>
            <div class="d-flex justify-content-between align-items-center mt-4 mr-3">

                <a class="fs-1" href="{{ route('register-page') }}">تسجيل</a>
                <a class="fs-1 ml-3" href="">هل نسيت كلمة المرور</a>
            </div>
        </form>
        
    </div> --}}


    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    {{-- <script src="../../assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js "></script> --}}
    {{-- <!-- apps -->
    <script src="../../dist/js/app.min.js "></script>
    <script src="../../dist/js/app.init.js "></script>
    <script src="../../dist/js/app-style-switcher.js "></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js "></script>
    <script src="../../assets/extra-libs/sparkline/sparkline.js "></script>
    <!--Wave Effects -->
    <script src="../../dist/js/waves.js "></script>
    <!--Menu sidebar -->
    <script src="../../dist/js/sidebarmenu.js "></script>
    <!--Custom JavaScript --> --}}
    {{-- <script src="../../dist/js/custom.min.js "></script> --}}
</body>

</html>