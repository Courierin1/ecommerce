<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Christian Creations Unlimited</title>

    <!-- Css Files Start -->
    <link rel="icon" href="{{asset('images/shellie-logo.png')}}" type="image/gif" sizes="16x16">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/hover.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/plugins.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/slick.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/slick-theme.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/fancybox.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">


    <!-- Fonts Links -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900,900i&display=swap"
        rel="stylesheet">


    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>



    <style>
        .post {
    border-bottom: 1px solid #e5e5e5;
    padding-bottom: 1%;
}

        .imgsize {
            width: 100px;
            height: 100px;
        }

        .imgsize img {
            height: 100px;
            object-fit: cover;
        }

        .nutral img.d-block.w-100 {
            height: 300px;
            object-fit: cover;
        }


        section.cta-sec {
            width: 100% !important;
        }

        textarea.form-control.mb-3 {
            border-radius: 0px;
            background-color: #dddddd;
            padding: 2% 5%;
            font-family: 'Poppins';
        }


        input#email123 {
            border-radius: 0px;
            background-color: #dddddd;
            padding: 2% !important;
            font-family: 'Poppins';
        }




        #search #newpost {
            position: fixed;
            top: 15px;
            right: 8%;
            color: #fff;
            background-color: #fe0606;
            border-color: #fe0606;
            opacity: 1;
            padding: 10px 17px;
            font-size: 27px;
        }




        .fade {
            opacity: 1;
            transition: opacity .15s linear;
        }

        div#search img.d-block.w-100 {
            border-radius: 11px;
            width: 85% !important;
            height: 200px;
            object-fit: cover;
        }

        .header_product_search_ajax {
            position: absolute !important;
            bottom: 5px !important;
            left: 0 !important;
            right: 0 !important;
            top: 220px;
        }

        div#search ul.nav.nav-pills {
            margin-bottom: 1% !important;
        }

        div#search h1 {
            text-align: center;
            position: relative;
            top: 3%;
            font-size: 49px;
            text-transform: uppercase;
            font-weight: bold;
        }

        div#search .simple {
            background-color: unset;
        }

        div#search img.d-block.w-100 {
            border-radius: 11px;
            width: 85% !important;
        }

        div#search section#blog .col-md-4:hover .simple {
            background-color: unset;
            color: black;
        }

        div#search section#blog .col-md-4:hover .simple h1 {
            color: black !important;
        }

        div#search .simple h1 {
            font-size: 13px;
            text-align: left;
            padding-top: 3%;
            color: black !important;
        }

        #search .search {
            position: absolute;
            top: 23%;
            width: 50%;
            color: rgb(255, 255, 255);
            background: rgb(231 231 231);
            font-size: 16px;
            font-weight: 300;
            text-align: center;
            border: 0px;
            margin: 0px auto;
            margin-top: -51px;
            padding-left: 30px;
            padding-right: 30px;
            outline: none;
            left: 0;
            right: 0;

            padding-top: .8%;
            padding-bottom: .8%;
            text-align: left;
            color: black !important;
        }

        div#search .simple h1 {
            font-size: 13px;
            text-align: left;
            padding-top: 3%;
            color: black !important;
            margin-bottom: 9%;
        }

        div#search section#blog {
            position: absolute !important;
            bottom: 0px !important;
            left: 0 !important;
            right: 0 !important;
        }

        div#search .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #5a2982;
            background-color: black;
            color: white;
            border-radius: 50px;
        }


        div#search a.nav-link.active:after {
            position: absolute;
            content: "";
            background-color: unset;
            width: 50px;
            height: 3px;
            left: 7px;
            top: -8px;
        }

        div#search a.nav-link {
            font-size: 13px;
        }


        @media (max-width:1366px) {

            .header_product_search_ajax {
                position: absolute !important;
                bottom: 5px !important;
                left: 0 !important;
                right: 0 !important;
                top: 120px;
            }

            #search .search {
                position: absolute;
                top: 19%;
                width: 70%;
                color: rgb(255, 255, 255);
                background: rgb(231 231 231);
                font-size: 16px;
                font-weight: 300;
                text-align: center;
                border: 0px;
                margin: 0px auto;
                margin-top: -51px;
                padding-left: 30px;
                padding-right: 30px;
                outline: none;
                left: 0;
                right: 0;

                padding-top: .8%;
                padding-bottom: .8%;
                text-align: left;
                color: black !important;
            }

            div#search img.d-block.w-100 {
                border-radius: 11px;
                width: 100% !important;
            }

            div#search h1 {
                text-align: center;
                position: relative;
                top: 1%;
                font-size: 34px;
                text-transform: uppercase;
                font-weight: bold;
            }

        }
        .scroll {
    position: relative;
    background-color: white;
    width: 50%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 16.5%;
    padding: 1%;
    height: 450px;
    overflow-y: scroll;
}

        .descriptionopp {
            width: fit-content;
    position: absolute;
    right: 38px;
    left: 15%;
    margin-top: -7%;
}

.post {
    margin-top: 1%;
}


.descriptionopp  p {
    line-height: 7px;
    color: black;
}
#navbar_top ul li a{
    font-size: 15px
}

    </style>



</head>

<body>
    <section class="topbar py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <a class="navbar-logo pull-right" href="{{route('home')}}"><img
                            src="{{asset('images/Shellie_Logo_Design-01.png')}}" class="img-fluid" alt=""></a>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 offset-md-1">
                    <ul class="pull-right">

                    <li>
                            <a href="#search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <!-- @if(Auth::check()) -->
                            <a href="{{route('cart')}}"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                (<span
                                    id="cart-quantity">{{\Cart::session('sessioncart')->getTotalQuantity()}}</span>)
                            </a>
                            <!-- @endif -->

                        </li>

                        @guest

                        <li>
                            <a href="{{ route('signup_options') }}">
                                <i class="fa fa-user" aria-hidden="true"></i> Login
                            </a>
                        </li>
                        <a href="{{route('cart')}}" style="color : #6d0018"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                (<span
                                    id="cart-quantity">{{\Cart::session('sessioncart')->getTotalQuantity()}}</span>)
                            </a>
                        @else
                        <li>
                            @if(Auth()->user()->role==2 || Auth()->user()->role==3)
                            <a href="{{ route('user.dashboard') }}">
                                <i class="fa fa-user" aria-hidden="true"></i> Dashboard
                            </a>
                            @else
                            <!-- <a href="{{ route('user.profile') }}">
                                <i class="fa fa-user" aria-hidden="true"></i> Profile
                            </a> -->
                            @endif
                        </li>
                        <li class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ substr(Auth::user()->name,0,8)}}... <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                        <!-- <li><a href="#search"><i class="fa fa-search" aria-hidden="true"></i> Search</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Header Start -->
    <div class="navigation-wrap start-header start-style" id="navbar_top">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-sm-12">
                    <header>
                        <nav>
                            <ul>
                                <li><a href="{{route('home')}}"
                                        class="{{\Route::current()->getName() == 'home' ? 'active' : ''}}">Home</a></li>
                                <li><a href="{{route('mission')}}"
                                        class="{{\Route::current()->getName() == 'mission' ? 'active' : ''}}">Mission</a>
                                </li>
                                <li><a href="{{route('about-us')}}"
                                        class="{{\Route::current()->getName() == 'about-us' ? 'active' : ''}}">About</a>
                                </li>
                                {{-- <li><a href="{{route('pricing_list')}}"
                                        class="{{\Route::current()->getName() == 'pricing_list' ? 'active' : ''}}">Pricing</a>
                                </li> --}}
                                <li><a href="{{route('kits')}}"
                                    class="{{\Route::current()->getName() == 'kits' ? 'active' : ''}}">Kits</a>
                                </li>
                                <li class="dropdown shop">
                                    <a href="{{route('shop')}}"
                                        class="{{\Route::current()->getName() == 'shop' ? 'active' : ''}}">
                                        Shop <i class="fa fa-angle-down ml-2" aria-hidden="true"></i>
                                    </a>

                                    <ul class="dropdown-menu drop category">
                                        <!-- <a class="dropdown-item" href="{{route('earrings')}}">Earrings</a>
                                        <a class="dropdown-item" href="{{route('bracelets')}}">Bracelets</a>
                                        <a class="dropdown-item" href="{{route('necklaces')}}">Necklaces</a>
                                        <a class="dropdown-item" href="{{route('earrings-necklaces')}}">Earrings & Necklace
                                            Sets</a> -->
                                    </ul>
                                </li>

                                <li><a href="{{route('party')}}"
                                        class="{{\Route::current()->getName() == 'party' ? 'active' : ''}}">Parties</a>
                                </li>
                                <li><a href="{{route('giving')}}"
                                        class="{{\Route::current()->getName() == 'giving' ? 'active' : ''}}">Giving</a>
                                </li>
                                <li><a href="{{route('angel-numbers')}}"
                                        class="{{\Route::current()->getName() == 'angel-numbers' ? 'active' : ''}}">Bible Verses</a></li>



                                <li><a href="{{route('contact-us')}}"
                                        class="{{\Route::current()->getName() == 'contact-us' ? 'active' : ''}}">Contact</a>
                                </li>
                            </ul>
                            <ul class="social p-0 pull-right pt-2">
                                <li class="d-inline-block"><a style="color : #6d0018"
                                        href="https://www.facebook.com/Christian-Creations-Unlimited-102401432369545/"
                                        target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li class="d-inline-block"><a style="color : #6d0018"
                                        href="https://instagram.com/christiancreationsunlimited?igshid=YmMyMTA2M2Y="
                                        target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <!-- <li class="d-inline-block"><a
                                        href="https://twitter.com/ccuangel444?s=21&t=eO0T5apjhnInaUK72eAgow"
                                        target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li> -->
                                <li class="d-inline-block"><a style="color : #6d0018" href="https://pin.it/23aF5Km"><i class="fa fa-pinterest"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </nav>
                        <div class="menu-toggle"><i class="fa fa-bars"></i></div>
                    </header>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    @yield('content')

    <!-- Footer Section -->
    <footer class="pb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-content text-center">
                        <ul class="socialli p-0 mt-5">
                            <li class="d-inline-block">
                                <a href="https://www.facebook.com/Christian-Creations-Unlimited-102401432369545/"
                                    target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            </li>
                            <!-- <li class="d-inline-block">
                                <a href="https://twitter.com/ccuangel444?s=21&t=eO0T5apjhnInaUK72eAgow"
                                    target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            </li> -->

                            <li class="d-inline-block">
                                <a href="https://instagram.com/christiancreationsunlimited?igshid=YmMyMTA2M2Y="
                                    target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </li>
                            <li class="d-inline-block">
                                <a href="javascript:void(0)"
                                    target="_blank"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                        <ol>
                            <li class="d-inline-block"><a href="#">Income Disclosure Statement</a></li>
                            <li class="d-inline-block"><a href="#">Return Policy</a></li>
                            <li class="d-inline-block"><a href="#">Privacy Policy</a></li>
                        </ol>
                        <p class="text-white">©2023 Christian Creations Unlimited. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer Section -->



    <div id="search" class="">

        <h1>Search For Products</h1>

        <button style="color: #fff!important;" type="button" class="close" id="newpost">×</button>
        <form>
            <input id="forms1" type="text" name="name" class="header_search_filter search" placeholder="Search For Products">

        </form>


        <div class="product_search_ajax scroll">



        </div>









    </div>




    <!-- Js Files Start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://gromo.github.io/jquery.scrollbar/jquery.scrollbar.js "></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- <script src="fb/jquery.fancybox.min.js"></script> -->
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <script>
        new WOW().init();

    </script>
    <script src="{{asset('js/jquery.mixitup.min.js')}}"></script>
    <script src="{{asset('js/slick.js')}}"></script>
    <!-- stats.js -->
    <script src="{{asset('js/particles.js')}}"></script>
    <script src="{{asset('js/jquery.fancybox.min.js')}}"></script>
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

        // document.querySelector(".second").addEventListener('click', function() {
        //     toastMixin.fire({
        //         animation: true,
        //         title: 'Signed in Successfully'
        //     });
        // });

        // document.querySelector(".third").addEventListener('click', function() {
        //     toastMixin.fire({
        //         title: 'Wrong Password',
        //         icon: 'error'
        //     });
        // });


        $(document).ready(function () {
            $.ajax({
                type: 'GET',
                url: '/api/categories',
                dataType: "json",
                async: true,
                success: function (response) {
                    if (response.data != null) {
                        let {
                            data
                        } = response;
                        data.forEach(element => {
                            // ...use `element`...
                            $("li.shop > ul.category").append(
                                `<a class="dropdown-item" href="{{route('shop')}}?id=${element.slug}-tab">${element.name}</a>`
                            );
                            console.log(element.name);
                        });

                    } else {

                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                }

            });
        });

    </script>


    <script>
        $(function () {
            $('a[href="#search"]').on('click', function (event) {
                event.preventDefault();
                $('#search').addClass('open');
                $('#search > form > input[type="search"]').focus();
            });

            $('#search, #search button.close').on('click keyup', function (event) {
                if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                    $(this).removeClass('open');
                }
            });



        });

    </script>

    <script>

        $(".scroll").hide();
        $(document).on('focusout', '.header_search_filter', function(e) {
            // $(this).val('');
            setTimeout(function(){
                $(".product_search_ajax").html('');
                $(".scroll").hide();
            }, 1000);

        });

        $(document).on('change keyup', '.header_search_filter', function(e) {
            let name = $('.header_search_filter').val();

            if ($('.header_search_filter').val().length < 3 &&  $('.header_search_filter').val().length >= 0)
            {
                $(".product_search_ajax").html('');
                $(".scroll").hide();

            }else {
            $.ajax({
                url: "{{ route('header_product_search_ajax') }}",
                method: "GET",
                data: {
                    name: name,
                },
                success: function (data) {
                    if (data.code == 200) {
                $(".scroll").show();
                      $(".product_search_ajax").html(data.view);
                    } else {
                      console.log('something went wrong');
                    }
                },
                error: function (error) {
                    alert('something went wrong');

                }
            });
        }
        });

// $(".scroll").hide();
// $(document).ready(function(){
//   $("#forms1").keydown(function(){

//     if( $("input#forms1").val().length > 2 ) {

//         $(".scroll").show();

//     }
//     else{
//         $(".scroll").hide();

//     }

//   });

// });
    </script>









    @yield('afterScript')
    <script>
        // Get all elements inside the body
    const allElements = document.body.getElementsByTagName('*');
    // Loop through each element
    for (let i = 0; i < allElements.length; i++) {
        const element = allElements[i];
        // Get the current font size as a string (e.g., "24px")
        const currentFontSize = window.getComputedStyle(element).fontSize;
        // Parse the font size string to extract the numeric value
        const currentSizeNumeric = parseInt(currentFontSize);
        // Calculate the new font size with an additional 2px
        const newSizeNumeric = currentSizeNumeric + 2;
        // Set the new font size for the element
        element.style.fontSize = newSizeNumeric + 'px';
    }
    </script>
    <script>
        var current_page = window.location.search
        // alert(current_page)

         if(current_page == "?id=earrings-tab"){
            $('#shop_text').html("Earrings")
         }
         else if(current_page == "?id=bracelets-tab"){
            $('#shop_text').html("Bracelets")
         }
         else if(current_page == "?id=necklaces-tab"){
            $('#shop_text').html("Necklaces")
         }
         else if(current_page == "?id=earrings--necklace-tab"){
            $('#shop_text').html("Earings & Necklaces sets")
         }
         else{
            $('#shop_text').html("Shop")
         }

    </script>
</body>

</html>
