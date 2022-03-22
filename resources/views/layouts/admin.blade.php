<!DOCTYPE html>
<html lang="en">


<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Admin Dashboard @yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- app favicon -->
    <link rel="shortcut icon" href="{{ asset('public/backend') }}/assets/img/favicon.ico">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/assets/css/vendors.css" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/assets/css/style.css" />
    <link rel="stylesheet" href="{{ asset('public/backend/assets/toaster/toastr.css')}}">
    <link rel="stylesheet" href="{{ asset('public/backend/assets/bootstrap-sweetalert/dist/sweetalert.css')}}">
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/dropify.min.css')}}">
</head>

<body>

    @guest

    @else
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            <!-- begin pre-loader -->
            <div class="loader">
                <div class="h-100 d-flex justify-content-center">
                    <div class="align-self-center">
                        <img src="{{ asset('public/backend') }}/assets/img/loader/loader.svg" alt="loader">
                    </div>
                </div>
            </div>
            <!-- end pre-loader -->

            <!-- begin app-header -->    

            @include('layouts.admin_partial.navbar')      
                
            <!-- end app-header -->

            <!-- begin app-container -->
            
            <div class="app-container">
                <!-- begin app-nabar -->
                @include('layouts.admin_partial.sidebar')

            @endguest
                <!-- end app-navbar -->
                <!-- begin app-main -->

                @yield('admin_content')

                <!-- end app-main -->
            </div>
            <!-- end app-container -->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->

    <!-- plugins -->
    <script src="{{ asset('public/backend') }}/assets/js/vendors.js"></script>

    <!-- custom app -->
    <script src="{{ asset('public/backend') }}/assets/js/app.js"></script>
    <!---alertjs file-->
    <script  src="{{ asset('public/backend/assets/toaster/toastr.min.js')}}"></script>
    <script  src="{{ asset('public/backend/assets/bootstrap-sweetalert/dist/sweetalert.min.js')}}"></script>

    {{-- droppify plugin --}}
    <script  src="{{ asset('public/backend/assets/js/dropify.min.js')}}"></script>

    {{-- printThis Plugun --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>

    
    <script>
        $('.dropify').dropify();
    </script>

    <script>
     @if(Session::has('messege'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('messege') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('messege') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('messege') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('messege') }}");
                  break;
          }
        @endif
    </script>

    <script>
        $(document).on("click", "#delete", function(e){
            e.preventDefault();
             var link = $(this).attr("href");
             swal({
              title: "Are you sure?",
              text: "You will not be able to recover this imaginary file!",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, delete it!",
              cancelButtonText: "No, cancel!",
            },
            function(isConfirm) {
              if (isConfirm) {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                window.location.href = link;
              } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
              }
            });
           });
   </script>

    <script>
        $(document).on("click", "#logout", function(e){
            e.preventDefault();
             var link = $(this).attr("href");
             swal({
              title: "Are you sure?",
              text: "You will not be able to recover this imaginary file!",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, logout it!",
              cancelButtonText: "No, cancel!",
            },
            function(isConfirm) {
              if (isConfirm) {
                swal("Deleted!", "You are logout.", "success");
                window.location.href = link;
              } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
              }
            });
           });
   </script>
</body>


</html>