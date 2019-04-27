<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RESET PASSWORD</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />

        <link rel="shortcut icon" href="images/favicon.ico">

        <!-- Bootstrap core CSS -->
        <link href="{{asset('generic/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{asset('generic/css/style.css')}}" rel="stylesheet">        
        <link rel="stylesheet" type="text/css" href="{{asset('generic/css/colors/green.css')}}" />
    </head>
    <body>

        <!-- START HOME  -->
        <section class="bg-login">
            <!-- <div class="bg-overlay"></div> -->
            <div class="login-table">
                <div class="login-table-cell">
                    <div class="container">
                        <div class="row justify-content-center mt-4">
                            <div class="col-lg-4">
                                <!-- <div class="text-center page-heading">
                                    <h1 class="text-white">Globing</h1>
                                    <p class="text-white">Responsive Bootstrap Landing Template</p>
                                </div> -->
                                @include('generic._components.notifications')
                                
                                <div class="bg-white p-4 rounded">
                                    <div class="text-center">
                                        <h4 class="font-weight-bold mb-3">Change your Password</h4>
                                    </div>
                                    <h6 class="text-center text-muted font-weight-normal forgot-pass-txt">To complete the process please enter your new password.</h5>
                                    <form class="login-form" method="POST">
                                        {!!csrf_field()!!}
                                        <div class="row">
                                            <div class="col-lg-12 mt-3">
                                                <input type="password" name="password" class="form-control" placeholder="New Password" required="">
                                            </div>
                                            <div class="col-lg-12 mt-3">
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password" required="">
                                            </div>
                                            <div class="col-lg-12 mt-4 mb-2">
                                                <button class="btn btn-custom w-100" type="submit">Update Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="text-center mt-3">
                                    <p><small class="text-white mr-2">Already have account?</small> <a href="login.html" class="text-white font-weight-bold">Sign in</a></p>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END HOME -->

        

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="{{asset('generic/js/jquery.min.js')}}"></script>
        <script src="{{asset('generic/js/popper.min.js')}}"></script>
        <script src="{{asset('generic/js/bootstrap.min.js')}}"></script>

    </body>
</html>