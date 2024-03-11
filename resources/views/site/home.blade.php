@extends('layout.site.app')
<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('title', 'Home')

@section('content')
<style>
   section.teamsec {
    /* background-position: 96%; */
    overflow-x: hidden;
    background-size: contain;
    background-repeat: no-repeat;
    height: 540px;
    padding: 120px 0px !important;
    overflow: hidden !important;
}
    @media only screen and (max-width: 1441px){
section.teamsec {
    /* background-position: 96%; */
    overflow-x: hidden;
    background-size: contain;
    background-repeat: no-repeat;
    height: 420px;
    padding: 80px 0px !important;
    overflow:  hidden !important;

}
}
@media only screen and (max-width: 992px){
section.teamsec {
    /* background-position: 96%; */
    overflow-x: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    height: 378px;
    padding: 80px 0px !important;
    overflow:  hidden !important;

}
}
@media only screen and (max-width: 480px){
section.teamsec {
    background-position: 83%;
    overflow-x: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    height: 378px;
    padding: 80px 0px !important;
    overflow:  hidden !important;

}
}
.teamdiv ul li {
    font-size: 19px;
}
section.parties-sec {
    background-image: url(../images/jwelleryforparty.png);
    /* padding: 200px 0; */
    padding: 125px 0;
    background-size: contain !important;
    /* margin-top: 100px; */
    border-top: 50px solid #f6931e;
    border-bottom: 50px solid #f6931e;
    background-repeat: no-repeat !important;
    background-position: -160px !important;
    background-color: #000 !important
}
section.parties-sec2 {
    background-image: url(../images/partyshot2.png);
    /* padding: 200px 0; */
    /* padding: 125px 0; */
    background-size: contain !important;
    /* margin-top: 100px; */
    border-top: 50px solid #f6931e;
    border-bottom: 50px solid #f6931e;
    background-repeat: no-repeat !important;
    /* background-position: -160px !important; */
    background-color: #f6931e !important
}
.animation::before{
    position: absolute;
    content: "";
    background: url(../images/teambg.jpg) #000;
    width: 100%;
    height: 630px;
    top: -80px;
    z-index: -1;
    background-size: cover;
    animation: fade-in-scale-down 5s infinite;
}
@media (max-width: 1920px) {
    section.parties-sec {
    background-image: url(../images/jwelleryforparty.png);
    /* padding: 200px 0; */
    padding: 125px 0;
    background-size: contain !important;
    /* margin-top: 100px; */
    border-top: 50px solid #f6931e;
    border-bottom: 50px solid #f6931e;
    background-repeat: no-repeat !important;
    background-position: 50px !important;
    background-color: #000 !important;
}
section.parties-sec2 {
    background-image: url(../images/partyshot2.png);
    /* padding: 200px 0; */
    /* padding: 125px 0; */
    background-size: contain !important;
    /* margin-top: 100px; */
    border-top: 50px solid #f6931e;
    border-bottom: 50px solid #f6931e;
    background-repeat: no-repeat !important;
    /* background-position: 50px !important; */
    background-color: #f6931e !important;
}
}
@media (max-width: 1600px) {
    section.parties-sec {
    background-image: url(../images/jwelleryforparty.png);
    /* padding: 200px 0; */
    padding: 125px 0;
    background-size: contain !important;
    /* margin-top: 100px; */
    border-top: 50px solid #f6931e;
    border-bottom: 50px solid #f6931e;
    background-repeat: no-repeat !important;
    background-position: -87px !important;
    background-color: #000 !important;
}
section.parties-sec2 {
    background-image: url(../images/partyshot2.png);
    /* padding: 200px 0; */
    /* padding: 125px 0; */
    background-size: contain !important;
    /* margin-top: 100px; */
    border-top: 50px solid #f6931e;
    border-bottom: 50px solid #f6931e;
    background-repeat: no-repeat !important;
    /* background-position: -87px !important; */
    background-color: #f6931e !important;
}
}
@media (max-width: 1000px) {
    section.parties-sec {
    background-image: url(../images/jwelleryforparty.png);
    /* padding: 200px 0; */
    padding: 125px 0;
    background-size: contain !important;
    /* margin-top: 100px; */
    border-top: 50px solid #f6931e;
    border-bottom: 50px solid #f6931e;
    background-repeat: no-repeat !important;
    background-position: center right !important;
    background-color: #000 !important
}
section.parties-sec2 {
    background-image: url(../images/partyshot2.png);
    /* padding: 200px 0; */
    /* padding: 125px 0; */
    background-size: contain !important;
    /* margin-top: 100px; */
    border-top: 50px solid #f6931e;
    border-bottom: 50px solid #f6931e;
    background-repeat: no-repeat !important;
    background-position: center right !important;
    background-color: #f6931e !important
}
}
.teamdiv.bg-black2
{
    background:linear-gradient(90deg ,#F6931E 50%, transparent 50%);
    background-color: transparent !important
}
.category-heading a{font-size: 18px !important}
section.productsec .nav-link{font-size: 15px !important}
</style>


<!-- Team sec -->

{{-- <div style="background: #F6931E">
    <div style="background: url({{asset('images/bg.png')}});">
    <div class="responsive2">

                <section class="teamsec">
                    <div class="container mr-container-10">
                    @if(session('success'))
                                            <div class="alert alert-success">{{session('success')}}</div>
                                        @endif
                                        @if(session('error'))
                                            <div class="alert alert-danger">{{session('error')}}</div>
                                        @endif
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-xs-12 ">
                                <div class="teamdiv bg-black2 border-red">
                                    <div>
                                        <h2 class="text-left text-red">Join The Team</h2>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <ul>
                                                    <li class="text-white"> <i class="fa fa-star" aria-hidden="true"></i> Sell Christian Jewelry
                                                    </li>
                                                    <li class="text-white"> <i class="fa fa-star" aria-hidden="true"></i> Work From Home
                                                    </li>
                                                    <li class="text-white"> <i class="fa fa-star" aria-hidden="true"></i> Flexible Hours
                                                    </li>
                                                    <li class="text-white"> <i class="fa fa-star" aria-hidden="true"></i> Be Your Own Boss
                                                    </li>
                                                    <li class="text-white text-nowrap"> <i class="fa fa-star" aria-hidden="true"></i> Earn up to 60% of the commission
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <p class="mt-2"><a href="{{route('kits')}}" class="theme-btn text-yellow">Join Now</a></p>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </section>


    </div>
     </div>
        </div> --}}

{{-- <section class="bg-black">
    <div class="container">
    @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
        <div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12 ">
                <div class="teamdiv">
                    <h2 class="text-left">Join The Team</h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <ul>
                                <li class="text-white"> <i class="fa fa-star" aria-hidden="true"></i> Sell Christian Jewelry
                                </li>
                                <li class="text-white"> <i class="fa fa-star" aria-hidden="true"></i> Work From Home
                                </li>

                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <ul>
                                <li class="text-white"> <i class="fa fa-star" aria-hidden="true"></i> Flexible Hours
                                </li>
                                <li class="text-white"> <i class="fa fa-star" aria-hidden="true"></i> Be Your Own Boss
                                </li>
                            </ul>
                        </div>
                    </div>
                    <p class="mt-2"><a href="{{route('kits')}}" class="theme-btn text-yellow">Join Now</a></p>

                    <p style="color:white;" class="">Earn up to 60% of the commission</p>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Team sec -->

<!-- parties sec -->
<!-- <section class="parties-sec">
    <div class="container">
        <div class="parties-heading bg-black2 text-white">
            <h2>Parties With a Purpose</h2>
            <p>Sharing The Love Of Jesus</p>
            <a href="{{route('kits')}}" class="theme-btn">Join Now</a>
        </div>
    </div>
</section> -->


{{-- <div class="responsive" style="height: fit-content;" id="parties_with">
    <div>
        <section class="parties-sec animation my-4">
            <div class="container">
                <div class="parties-heading bg-black2 text-white">
                    <h2>Parties <br> With a <br> Purpose</h2>
                    <p>Sharing <br> The Love <br>Of  Jesus</p>
                    <a href="{{route('kits')}}" class="theme-btn text-yellow">Join Now</a>
                </div>
            </div>
        </section>
    </div>
    <div>
        <section class="parties-sec2 animation my-4">
            <div class="container">
                <div class="parties-heading bg-black2 text-white">
                    <h2>Parties <br> With a <br> Purpose</h2>
                    <p>Sharing <br> The Love <br>Of  Jesus</p>
                    <a href="{{route('kits')}}" class="theme-btn text-yellow">Join Now</a>
                </div>
            </div>
        </section>
    </div>
</div> --}}
  {{-- <section class="bg-black">
    <div class="container">
        <div class="parties-heading  text-white">
            <h2>Parties With a Purpose</h2>
            <p>Sharing The Love Of Jesus</p>
            <a href="{{route('kits')}}" class="theme-btn">Join Now</a>
        </div>
    </div>
</section> --}}
<!-- parties sec -->
<!-- Banner Section -->

<section class="bg-dark" style="border-bottom: 50px solid #F6931E">
    <div class="row bg-img">
        <div class="col-md-6 d-flex justify-content-center align-items-center flex-column heading-title" >
            <div style="background: #F6931E;" class="p-3 border-red">
                <div>
                    <h2 class="text-left text-red">Join The Team</h2>
                    <div class="row">
                        <div class="col-12">
                            <ul>
                                <li class="text-purple"> <i class="fa fa-star" aria-hidden="true"></i> Sell Christian Jewelry
                                </li>
                                <li class="text-purple"> <i class="fa fa-star" aria-hidden="true"></i> Work From Home
                                </li>
                                <li class="text-purple"> <i class="fa fa-star" aria-hidden="true"></i> Flexible Hours
                                </li>
                                <li class="text-purple"> <i class="fa fa-star" aria-hidden="true"></i> Be Your Own Boss
                                </li>
                                <li class="text-purple text-nowrap"> <i class="fa fa-star" aria-hidden="true"></i> Earn up to 60% of the commission
                                </li>
                            </ul>
                        </div>

                    </div>
                    <p class="mt-2"><a href="{{route('kits')}}" class="theme-btn text-yellow">Join Now</a></p>
            </div>
        </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <img src="{{asset('images/z_home.png')}}" alt="" class="img-fluid">
        </div>
    </div>
</section>

<section class="bg-dark" style="border-bottom: 50px solid #F6931E">
    <div class="row bg-img">
        <div class="col-md-6 d-flex justify-content-center align-items-center flex-column heading-title" >
            <div style="background: #F6931E;" class="p-3 border-red">
                <h1 class="text-red fw-600 mx-2" style="font-size : 54px"><span>Parties With a Purpose</span></h1>
                <p class="text-purple">Sharing The Love Of Jesus</p>
            <a href="{{route('kits')}}" class="theme-btn text-yellow">Join Now</a>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <img src="{{asset('images/partyshot2.png')}}" alt="" class="img-fluid">
        </div>
    </div>
</section>

<section class="bg-dark">
    <div class="row bg-img">
        <div class="col-md-6 d-flex justify-content-center align-items-center flex-column heading-title " >
            <div style="background: #F6931E" class="p-2 text-left border-red">
                <h1 class="text-purple fw-600" style="font-size: 56px"><span>Styling</span></h1>
                <h1 class="text-purple fw-600" style="font-size: 56px">with the <span>Spirit</span></h1>

            </div>
        </div>
        <div class="col-md-6">
            <img src="{{asset('images/Liz_Styling_with_the_spirit.JPG')}}" alt="" class="img-fluid">
        </div>
    </div>
</section>



{{-- <section id="featured-post">
    <div id="slide-container">
        <div id="slides">
            <article class="featured-article">
                 <a href="#" title=""> <img src="{{asset('images/banner.jpg')}}">
                <a href="#" title=""> <img src="{{asset('images/Liz_Styling_with_the_spirit.JPG')}}">
                    <div class="caption-container">
                        <div class="caption">
                            <h1><span>Styling</span></h1>
                            <h1>with the <span>Spirit</span></h1>
                        </div>
                        <div>
                </a>
            </article>



            <article class="featured-article animated">
                 <a href="#" title=""> <img src="{{asset('images/banner.jpg')}}">
                <a href="#" title=""> <img src="{{asset('images/liz_back_necklace.png')}}">
                    <div class="caption-container">
                        <div class="caption">
                            <h1><span>Styling</span></h1>
                            <h1>with the <span>Spirit</span></h1>
                        </div>
                        <div>
                </a>
            </article>

        </div>
        <div class="button-slide">
             button and dots indicator
            <ul id="dots" class="dots-container">
                <li>01</li>
                <li>02</li>
                <li>03</li>
            </ul>
        </div>
    </div>
</section> --}}
<!-- Banner Section -->

<!-- product Category -->
<section class="categorysec">
    <div class="container">
        @if (isset($categories))
        <div class="row">
            @foreach ($categories as $category)

            <div class="col-md-{{ceil(abs(12/count($categories)))}} col-sm-4 col-xs-6 col-4">
                <div class="category-heading text-center">
                    <a href="{{route('shop')}}?id={{$category['slug']}}-tab"
                        class="text-white">{{$category['name']}}</a>

                </div>
            </div>
            @endforeach

        </div>
        @endif
    </div>
</section>
<!-- product Category -->





<!-- Product Sec -->
<section class="productsec">

    <div class="container" id="featured">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <h3>Featured Products</h3>
            </div>
            <div class="col-md-8 col-sm-8">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{isset($_GET['id']) ? ($_GET['id'] == 'all-tab' ? 'active' : '') : 'active' }}" onclick="showTabProduct('all');" id="all-tab" href="javascript:;">All</a>
                    </li>
                    @if (isset($categories))
                    @foreach ($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link {{ isset($_GET['id']) && $_GET['id'] == $category['slug'].'-tab' ? 'active' : ''}}"" onclick="showTabProduct('{{$category["slug"]}}');" id="{{$category['slug']}}-tab"
                            href="javascript:;">{{$category['name']}}</a>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="your-class h-fit">

        </div>
    </div>
</section>
<!-- Product Sec -->
@endsection


@section('afterScript')
<script>
    $(function () {
        $('a[data-toggle="tab"]').on('click', function (e) {
            window.localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = window.localStorage.getItem('activeTab');
        if (activeTab) {
            $('#myTab a[href="' + activeTab + '"]').tab('show');
            window.localStorage.removeItem("activeTab");
        }
    });

</script>
<script>
    @if(!isset($_GET['id']) || isset($_GET['id']) && substr($_GET['id'],0,strpos($_GET['id'], "-"))=='all')
    $(document).ready(function () {
        showTabProduct('all');
    });
    @elseif(isset($_GET['id']) && substr($_GET['id'],0,strpos($_GET['id'], "-"))!='all')
    $(document).ready(function () {

        showTabProduct("{{substr($_GET['id'],0,strpos($_GET['id'], '-'))}}");

    });
    @endif

    function showTabProduct(elem) {
        // var id = $(elem).attr("id");
        // var slug = id.split("-")[0].toLowerCase();
        var slug = elem.toLowerCase();
        var data = {}
        if (slug != 'all') {
            data['category'] = [slug];
        }
        console.log(data);
        $.ajax({
            url: "/api/products",
            method: "POST",
            data: data,
            success: function (data) {
                var response = JSON.parse(data);
                console.log(response,'sd');
                if (response.length > 0) {
                    var html = '';
                    response.forEach(element => {

price = element.sale_price;
@if (Auth()->check() && Auth()->user()->is_consultant == 1)
    price = element.sale_price;
@else
     switch(element.categories[0].slug){
            case 'earrings':
            price=4.44;
                break;
            case 'bracelets':
            price=8.88;
                break;
            case 'necklaces':
            price=8.88;
                break;
            case 'earrings-necklace-sets':
            price=14.44;
                break;
            case 'earrings-necklace':
            price=14.44;
                break;
            case 'earrings--necklace':
            price=14.44;
                break;
        }

        @endif
                        var images = JSON.parse(element.gallery_images);
                        if (typeof images !== 'undefined' && images[1] !== undefined && images[1] !== null) {
                            var scrimage=images[1]
                        } else {
                            var scrimage="{{ asset('admin_assets/assets/img/null_thumbnail.png') }}"
                            }
                                                // console.log(images)
//console.log(scrimage);
                        html += `<div>
                                    <div class="product-image">
                                <a href="/product-detail/${element.slug}">
                                        <img src="${scrimage}" alt="${element.slug}">
                                        <h4>${element.name}</h4>
                                </a>
                                        <div class="row">
                                            <div class="col-sm-6 col-6">
                                                <p>$${price}</p>
                                            </div>
                                            <div class="col-sm-6 col-6 d-flex justify-content-end">
                                            <!--  <button class = "btn btn-addToCart" data-type="types" data-kind="success" onclick="{{ Auth::check() ? 'javascript:addToCart(`+element.product_id+`);' : 'javascript:errortoast("Login To add to cart")' }}">Add</button> -->
                                                <button class = "btn btn-addToCart" data-type="types" data-kind="success" onclick = "onclick="javascript:addToCart(`+element.product_id+`)"">Add</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            `;
                    });
                }
                $(`.your-class`).html(html);
                if ($('.your-class').hasClass('slick-initialized')) {
                    $('.your-class').removeClass('slick-initialized')
                }
                if ($('.your-class').hasClass('slick-slider')) {
                    $('.your-class').removeClass('slick-slider')
                }
                $('.your-class').slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    responsive: [{
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                        // You can unslick at a given breakpoint now by adding:
                        // settings: "unslick"
                        // instead of a settings object
                    ]
                });
            }
        });

    }



        function addToCart(id){
            // alert(id);
            /* if(Auth::check() && Auth()->user()->consultant_id ==null) */
            // if(!Auth::check() )
           // alert('Please Become Consultant To Use This Feature!');
            // errortoast('Please Become Consultant To Use This Feature!');

            // window.location = '/login'

            // else
         $.ajax({

            url:"<?php echo  route('add.to.cart'); ?>",
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            type: "POST",
            data: {
                id: id,
                // _token: "{{ csrf_token() }}",

            },
            success: function (data) {
                if (data.status == 1) {
                    $('#cart-quantity').text(data.quantity);


                    // successtoast(data.message+" You Are Now Redirect to Signup");
                    @if(Auth::check()==false)
                   // window.location.href = "{{ route('register.consultant')}}";
                    setTimeout(function() {
                    window.location.href = "{{ route('signup_options')}}"
                     }); // 2 second
                    @endif


                }
                else if (data.status == 2) {
                    //alert(data.message);
                    errortoast(data.message);
                }
                else {
                  //  alert('something went wrong');
                    // errortoast('something went wrong');
                }
            },
            error: function (error) {
               // alert('something went wrong');
                errortoast('something went wrong');

            }
        });
        // endif
    }
    $("section.productsec .nav-link").click(function(){

  $("a.nav-link").removeClass("active");
  $(this).addClass("active");
});
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $('.responsive').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,

  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
});
</script>
<script>
    $('.responsive2').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,

  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
});
</script>
@endsection
