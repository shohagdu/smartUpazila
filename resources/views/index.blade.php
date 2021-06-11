<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- favicon css -->
    <link rel="shortcut icon" type="imgage/png" href="img/favicon.png">
    <!-- font css -->
    <link rel="stylesheet" href="font/font.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- all subpage css -->
    <link rel="stylesheet" href="css/subpage.css">
    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- responsive css  -->
    <link rel="stylesheet" href="css/responsive.css">
    <title>
         @yield('title_area')
    </title>
  </head>
  <body>
    <!-- common header nav slider start -->
    @include('common_layout.header')
    <!-- common header nav slider end -->
    <!-- all union content start -->
    @yield('all_union_content')
    <!-- all union content start -->

    <!--  1st sectin start -->
    <section id="first_scction">
        <div class="container page_shadow">
            <div class="full_sec_con_wrap"> <!-- full_sec_con_wrap -->
                <div class="row">
                    @yield('main_content_area')
                    @include('common_layout.right_side')
                </div>
            </div>
        </div>
    </section>
    @include('common_layout.footer')
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
