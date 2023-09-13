<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>Sunny Admin - Dashboard</title>

	<link rel="stylesheet" href="{{asset('backend/css/vendors_css.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/skin_color.css')}}">

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
     
  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">

  @include('admin.body.header')


  @include('admin.body.sidebar')

 
  <div class="content-wrapper">

    @yield('content')
	  
  </div>
  
 @include('admin.body.footer')

  
</div>

	<script src="{{asset('backend/js/vendors.min.js')}}"></script>
  <script src="{{asset('backend/assets/icons/feather-icons/feather.min.js')}}"></script>	
	<script src="{{asset('backend/assets/vendor_components/easypiechart/dist/jquery.easypiechart.js')}}"></script>
	<script src="{{asset('backend/assets/vendor_components/apexcharts-bundle/irregular-data-series.js')}}"></script>
	<script src="{{asset('backend/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script>
	<script src="{{asset('backend/js/template.js')}}"></script>
	<script src="{{asset('backend/js/pages/dashboard.js')}}"></script>
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<script>
            
            @if(Session::has('message'))

            var type = "{{Session::get('alert-type','info')}}"

            switch(type){

                case 'info':
                    toastr.info("{{Session::get('message')}}");
                break;

                case 'success':
                    toastr.success("{{Session::get('message')}}");
                break;

                case 'warning':
                    toastr.warning("{{Session::get('message')}}");
                break;

                case 'error':
                    toastr.error("{{Session::get('message')}}");
                break;
            }

            @endif
                
        </script>
	
</body>
</html>
