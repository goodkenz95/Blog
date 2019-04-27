<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>INVALID TOKEN</title>
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
                                <div class="bg-white p-4 mt-5 rounded">
                                    <div class="text-center">
                                        <h4 class="font-weight-bold mb-3">INVALID TOKEN</h4>
                                    </div>
                                    <h6 class="text-center text-muted font-weight-normal forgot-pass-txt">Validation token is invalid or already expired.</h5>
                                    <form class="login-form">
                                        <div class="row">
                                            <div class="col-lg-12 mt-4 mb-2">
                                                <a href="#" class="btn btn-custom w-100">Go back to Home</a>
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