<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
        rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

    <!-- PLUGINS CSS STYLE -->
    <link href="{{asset ('admin_assets/assets/plugins/toaster/toastr.min.css')}}" rel="stylesheet" />
    <link href="{{asset ('admin_assets/assets/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
    <link href="{{asset ('admin_assets/assets/plugins/flag-icons/css/flag-icon.min.css')}}" rel="stylesheet" />
    <link href="{{asset ('admin_assets/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
    <link href="{{asset ('admin_assets/assets/plugins/ladda/ladda.min.css')}}" rel="stylesheet" />
    <link href="{{asset ('admin_assets/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset ('admin_assets/assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />


    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="{{asset ('admin_assets/assets/css/sleek.css')}}" />
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- FAVICON -->
    <!-- <link href="assets/img/favicon.png" rel="shortcut icon" /> -->

    <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script src="{{asset ('admin_assets/assets/plugins/nprogress/nprogress.js')}}"></script>


<style>

li.dropdown-header p {
    font-size: 14px;
}

</style>


</head>


<body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">
    <script>
    NProgress.configure({
        showSpinner: false
    });
    NProgress.start();
    </script>

    <div class="mobile-sticky-body-overlay"></div>

    <div class="wrapper">

        <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
        <aside class="left-sidebar bg-sidebar">
            <div id="sidebar" class="sidebar sidebar-with-footer">
                <!-- Aplication Brand -->
                <div class="app-brand">
                    <a href="#">
                        <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"
                            width="30" height="33" viewBox="0 0 30 33">
                            <g fill="none" fill-rule="evenodd">
                                <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                            </g>
                        </svg>
                        <span class="brand-name">
                            <img src="{{asset('images/shellie-logo.jpg')}}" alt="logo">
                        </span>
                    </a>
                </div>
                <!-- begin sidebar scrollbar -->
                <div class="sidebar-scrollbar">

                    <!-- sidebar menu -->
                    <ul class="nav sidebar-inner" id="sidebar-menu">

                        <!-- Categories -->

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#categories" aria-expanded="false" aria-controls="documentation">
                                <i class="mdi mdi-format-list-bulleted"></i>
                                <span class="nav-text">CATEGORIES</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="categories" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="{{route('admin.category.add')}}">
                                            <span class="nav-text">Add Categories</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="{{route('admin.category')}}">
                                            <span class="nav-text">View Categories</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <!-- Collection -->

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#collection" aria-expanded="false" aria-controls="documentation">
                                <i class="mdi mdi-image-album"></i>
                                <span class="nav-text">KITS</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="collection" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="{{route('admin.collection.add')}}">
                                            <span class="nav-text">Add Kits</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="{{route('admin.collection')}}">
                                            <span class="nav-text">View Kits</span>
                                        </a>
                                    </li>

                                </div>
                            </ul>
                        </li>

                        <!-- Products -->

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#products" aria-expanded="false" aria-controls="documentation">
                                <i class="mdi mdi-cart-plus"></i>
                                <span class="nav-text">Products</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="products" data-parent="#sidebar-menu">
                                <div class="sub-menu">


                                    <li>
                                        <a class="sidenav-item-link" href="{{route('admin.product.add')}}">
                                            <span class="nav-text">Add Products</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="{{route('admin.product')}}">
                                            <span class="nav-text">View Products</span>
                                        </a>
                                    </li>

                                </div>
                            </ul>
                        </li>

                        <!-- Attributes -->

                        <!-- <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#attributes" aria-expanded="false" aria-controls="documentation">
                                <i class="mdi mdi-tag-text-outline"></i>
                                <span class="nav-text">ATTRIBUTES</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="attributes" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Sizes</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Colors</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Style</span>
                                        </a>
                                    </li>
                                  
                                </div>
                            </ul>
                        </li> -->

                        <!-- Orders -->

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#orders" aria-expanded="false" aria-controls="documentation">
                                <i class="mdi mdi-sort-variant"></i>
                                <span class="nav-text">ORDERS</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="orders" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="{{route('admin.orders')}}">
                                            <span class="nav-text">Order Details</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <!-- Users -->

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#users" aria-expanded="false" aria-controls="documentation">
                                <i class="mdi mdi-account"></i>
                                <span class="nav-text">USERS</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="users" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="{{route('admin.customer')}}">
                                            <span class="nav-text">User Accounts</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#coupons" aria-expanded="false" aria-controls="documentation">
                                <i class="mdi mdi-account"></i>
                                <span class="nav-text">Coupon</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="coupons" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="{{route('admin.coupons')}}">
                                            <span class="nav-text">Coupons</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>


                        <li>
                            <a class="sidenav-item-link" href="{{route('admin.siteSettings')}}">
                                <i class="mdi mdi-account"></i>
                                <span class="nav-text">Site Settings</span> <b class="caret"></b>
                            </a>

                        </li>


                        <li>
                            <a class="sidenav-item-link" href="{{route('admin.email_notification')}}">
                                <i class="mdi mdi-account"></i>
                                <span class="nav-text">Email Notification</span> <b class="caret"></b>
                            </a>

                        </li>


                        <li>
                            <a class="sidenav-item-link" href="{{route('admin.profile')}}">
                                <i class="mdi mdi-account"></i>
                                <span class="nav-text">Account Settings</span> <b class="caret"></b>
                            </a>
                        </li>

                        <!-- <li>
                            <a class="sidenav-item-link" href="">
                                <i class="mdi mdi-account"></i>
                                <span class="nav-text">Import</span>
                            </a>

                        </li> -->



                    </ul>

                </div>

                <hr class="separator" />

                <div class="sidebar-footer d-none">
                    <div class="sidebar-footer-content">
                        <h6 class="text-uppercase">
                            Cpu Uses <span class="float-right">40%</span>
                        </h6>
                        <div class="progress progress-xs">
                            <div class="progress-bar active" style="width: 40%;" role="progressbar"></div>
                        </div>
                        <h6 class="text-uppercase">
                            Memory Uses <span class="float-right">65%</span>
                        </h6>
                        <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-warning" style="width: 65%;" role="progressbar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>



        <div class="page-wrapper">
            <!-- Header -->
            <header class="main-header " id="header">
                <nav class="navbar navbar-static-top navbar-expand-lg">
                    <!-- Sidebar toggle button -->
                    <button id="sidebar-toggler" class="sidebar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                    </button>
                    <!-- search form -->
                    <!-- <div class="search-form d-none d-lg-inline-block">
                        <div class="input-group">
                            <button type="button" name="search" id="search-btn" class="btn btn-flat">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <input type="text" name="query" id="search-input" class="form-control" placeholder="'button', 'chart' etc." autofocus autocomplete="off" />
                        </div>
                        <div id="search-results-container">
                            <ul id="search-results"></ul>
                        </div>
                    </div> -->

                    @php($notification_count=App\Notification::where('user_id', auth()->id())->where('seen',0)->count())
                    @php($notifications=App\Notification::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->where('seen',0)->take(5)->get())
                    <div class="navbar-right ">
                        <ul class="nav navbar-nav">

                            <li class="dropdown notifications-menu">
                                <button class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="mdi mdi-bell-outline"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-header">You have {{$notification_count}} notifications</li>
                                    
                                    @foreach($notifications as $notification)
                                    <li class="dropdown-header">
                                       
                                           <p>{{$notification->message}}</p>
                                        
                                           <p>{{date('M d,Y h:i A', strtotime($notification->created_at))}}</p>
                                      
                                    </li>
                                    @endforeach
                                    <li class="dropdown-footer">
                                        <a class="text-center" href="{{ route('notification_list') }}"> View All </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- User Account -->
                            <li class="dropdown user-menu">
                                <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <img src="{{asset('admin_assets/assets/img/admin-image.png')}}" class="user-image"
                                        alt="User Image" />
                                    <span class="d-none d-lg-inline-block">User Name</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <!-- User image -->


                                    <li class="dropdown-footer">
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="mdi mdi-logout"></i> {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>


            </header>


            @yield('content')

            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>
                        &copy; <span id="copy-year">2019</span> Copyright
                        <a class="text-primary" href="#" target="_blank"></a>.
                    </p>
                </div>
                <script>
                var d = new Date();
                var year = d.getFullYear();
                document.getElementById("copy-year").innerHTML = year;
                </script>
            </footer>

        </div>
    </div>


    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCn8TFXGg17HAUcNpkwtxxyT9Io9B_NcM" defer></script> -->
    <script src="{{ asset('admin_assets/assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/toaster/toastr.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/slimscrollbar/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/charts/Chart.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/ladda/spin.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/ladda/ladda.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/jquery-mask-input/jquery.mask.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/plugins/jekyll-search.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/js/sleek.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/js/chart.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/js/date-range.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/js/map.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/js/custom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <!-- <script src="//cdn.quilljs.com/1.3.6/quill.js"></script> -->
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.bindClickHandler();
        var toastMixin = Swal.mixin({
            toast: true,
            icon: 'success',
            title: 'General Title',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // document.querySelector(".first").addEventListener('click', function() {
        //     Swal.fire({
        //         toast: true,
        //         icon: 'success',
        //         title: 'Posted successfully',
        //         animation: false,
        //         position: 'bottom',
        //         showConfirmButton: false,
        //         timer: 3000,
        //         timerProgressBar: true,
        //         didOpen: (toast) => {
        //             toast.addEventListener('mouseenter', Swal.stopTimer)
        //             toast.addEventListener('mouseleave', Swal.resumeTimer)
        //         }
        //     })
        // });

        function successtoast(message) {
            toastMixin.fire({
                animation: true,
                title: message
            });
        }

        function errortoast(message) {
            toastMixin.fire({
                title: message,
                icon: 'error'

            });
        }
</script>


    @yield('afterScript')

</body>

</html>