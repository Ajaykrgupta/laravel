<!DOCTYPE html>
<html lang="en">
  <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ratna Sagar |  @yield('title')</title>
        <link href="{{ url('assets/layout/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('assets/layout/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ url('assets/layout/build/css/custom.min.css') }}" rel="stylesheet">
        <link href="{{ url('assets/layout/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('assets/layout/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('assets/layout/build/css/bootstrap-multiselect.css') }}" type="text/css" rel="stylesheet">
        <link href="{{ url('assets/layout/build/css/style.css') }}" type="text/css" rel="stylesheet">
        <link href="{{ url('assets/layout/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/layout/css/simplePagination.css') }}" type="text/css" rel="stylesheet">
        <script src="{{ url('assets/layout/js/jquery.min.js') }}"></script>
        <script src="{{ url('assets/js/saveAsExcel.js') }}"></script>
         <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
        <link href="{{ url('assets/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
  </head>
  <body class="nav-md">
    <div class="container">
      <div class="main_container">
        
    <script type="text/javascript">
    $("ul a").click(function(e) {
            var link = $(this);
            var item = link.parent("li");
            if (item.hasClass("active")) {
                item.removeClass("active").children("a").removeClass("active");
            } else {
                item.addClass("active").children("a").addClass("active");
            }
            if (item.children("ul").length > 0) {
                var href = link.attr("href");
                link.attr("href", "#");
                setTimeout(function () {
                    link.attr("href", href);
                }, 300);
                e.preventDefault();
            }
        })
        .each(function() {
            var link = $(this);
            if (link.get(0).href === location.href) {
                link.addClass("active").parents("li").addClass("active");
                return false;
            }
        });
</script>   
        
           <div class="loader" style="display:block"></div>
           <div class="right_col" role="main" style="display:none">
            <div class="">
            <div class="clearfix"></div>
            <div class="col-md-12">
            </div>
                 @yield("content")
            </div>
      </div>
    </div>
   <script type="text/javascript" src="{{ url('assets/layout/js/jquery-2.0.3.js') }}"></script>
   <script type="text/javascript" src="{{ url('assets/layout/js/bootstrap.min.js') }}"></script>
   <script type="text/javascript" src="{{ url('assets/layout/js/jquery.simplePagination.js') }}"></script>
   <script src="{{ url('assets/layout/build/js/custom.min.js') }}"></script>
   <script src="{{ url('assets/moment/min/moment.min.js') }}"></script>
   <script src="{{ url('assets/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }} "></script>
   <script type="text/javascript">
        $(window).load(function(){
           $(".loader").fadeOut("slow");
           $(".right_col").show();
        });
  </script>
  </body>
</html>
