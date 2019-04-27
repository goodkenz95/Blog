<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$page_title}}</title>
        {{-- <meta name="description" content="" /> --}}
        {{-- <meta name="keywords" content="" /> --}}
        <meta name="author" content="Go Negosyo" />

        {{-- <link rel="shortcut icon" href="images/favicon.ico"> --}}

        <!-- Bootstrap core CSS -->
        <link href="{{asset('generic/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{asset('generic/css/style.css')}}" rel="stylesheet">        
        <link rel="stylesheet" type="text/css" href="{{asset('generic/css/colors/green.css')}}" />
        <style type="text/css">
            .bg-login{ height: 100%; }
        </style>
    </head>
    <body>

        <!-- START HOME  -->
        <section class="bg-login">
            <!-- <div class="bg-overlay"></div> -->
            <div class="login-table">
                <div class="login-table-cell">
                    <div class="container">
                        <div class="row justify-content-center mt-4">
                            <div class="col-lg-12">
                                <div class="bg-white p-4 mt-5 rounded">
                                    <h1>Page not found.</h1>
                                </div>
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