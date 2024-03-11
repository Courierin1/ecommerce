@extends('layout.site.app')
@section('title', 'Shop')

@section('content')

<style>
    .fs-2{font-size: 92px !important}
</style>
 <!-- Banner Section -->
 <div class="container-fluid">
 @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
   @if(isset(Auth()->user()->consultant))
<div class="replicated-rep-container">
  <div class="replicated-rep clearfix">



  <img src="{{isset(Auth()->user()->consultant['image']) ? Auth()->user()->consultant['image'] : '/images/shellie-logo.jpg'}}"
                    class="img-fluid pull-left {{isset(Auth()->user()->consultant['image']) ? '' : 'styling_class' }}" alt="">

      <div class="pull-left">
        <h3 class="replicated-rep-company-or-name">
          {{Auth()->user()->consultant['name']}}
        </h3>

      </div>
      <div class="text-right pull-right">
        <p class="replicated-rep-social-media">
          <br>
          {{Auth()->user()->consultant['phone']}}<br>
          <a href="mailto:{{Auth()->user()->consultant['email']}}">{{Auth()->user()->consultant['email']}}</a><br>
          ID # {{Auth()->user()->consultant['unique_id']}}<br>
        </p>



      </div>




  </div>


</div>
@else
{{-- <div class="alert alert-danger " role="alert">
    <button type="button" class="close" data-dismiss="alert">
      <span aria-hidden="true">×</span>
    </button>
    <h2 style="text-align: center; background: none; padding-bottom: 0; color: #d00;">It looks like you haven't selected a Consultant yet!</h2>
<p style="text-align: center;color: #551d7c; font-size: 18px"><span>...were you just wanting to browse or were you looking to shop and pick a Consultant to shop under?</span></p>
    <div class="text-center">
    <button type="button" class="btn btn-pink" data-dismiss="alert">
      <span aria-hidden="true">Just Browsing</span>
    </button>
      <a class="btn btn-pink" href="{{route('consultant')}}">
        Choose a Consultant
      </a>
    </div>
  </div> --}}
@endif
 </div>
   <section class="innerbanner" style="background: #F6931E">

        <div class="inner-image" style="background: url({{asset('images/bg.png')}});">
            <!-- <img src="images/necklace.png" class="img-fluid w-100" alt=""> -->
            @if(isset($_GET['id']) && $_GET['id'] == 'earrings-tab')
            <img src="images/Earings2_1.png" class="img-fluid w-100" alt="" id="shop-banner-img">
            @elseif(isset($_GET['id']) && $_GET['id'] == 'bracelets-tab')
            <img src="images/liz_braclet_1.png" class="img-fluid w-100" alt="" id="shop-banner-img">
            @elseif(isset($_GET['id']) && $_GET['id'] == 'necklaces-tab')
            <img src="images/liz_cross_necklace_1.png" class="img-fluid w-100" alt="" id="shop-banner-img">
            @elseif(isset($_GET['id']) && $_GET['id'] == 'earrings--necklace-tab')
            <img src="images/liz_cross_pink_1.png" class="img-fluid w-100" alt="" id="shop-banner-img">
            @else
            <img src="images/Shop-page.png" class="img-fluid w-100" alt="" id="shop-banner-img">
            @endif
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="innercaption">
                        <h2 id="shop_text" class="text-purple fs-2 d-inline w-fit border-red" style="background: #F6931E; padding: 15px">Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section -->
    <!-- Banner Section -->


    <!-- Product Sec -->
    <!-- Product Sec -->
    <section class="your-class-parent productsec">

<div class="container mt-5" id="featured">
    <div class="row ">
        <div class=" col-md-4 col-sm-4">

            <h3 class="">Featured Products</h3>
        </div>
        <div class="col-md-8 col-sm-8">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{isset($_GET['id']) ? ($_GET['id'] == 'all-tab' ? 'active' : '') : 'active' }}" onclick="showTabProduct('all');" data-slug='all' id="all-tab" href="javascript:;">All</a>
                </li>
                @if (!empty($categories) && $categories->count())
                    @foreach ($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link {{ isset($_GET['id']) && $_GET['id'] == $category->slug.'-tab' ? 'active' : ''}}""
                        onclick="showTabProduct('{{$category->slug}}');" data-slug='{{$category->slug}}' id="{{$category->slug}}-tab"
                            href="javascript:;">{{$category->name}}</a>
                    </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="your-class" id="your-class">

    </div>

</div>
    {!! $categories->links() !!}
</section>
    <!-- Product Sec -->

    @endsection

    @section('afterScript')

    <script>
    @if(!isset($_GET['id']) || isset($_GET['id']) && substr($_GET['id'],0,strpos($_GET['id'], "-"))=='all')
    $(document).ready(function () {
        showTabProduct('all');
    });
    @elseif(isset($_GET['id']) && substr($_GET['id'],0,strpos($_GET['id'], "-"))!='all')
    $(document).ready(function () {

        @if (strpos($_GET['id'], '--'))
        showTabProduct("earrings--necklace");
        @else
        showTabProduct("{{substr($_GET['id'],0,strpos($_GET['id'], '-'))}}");
        @endif

    });
    @endif

    @if(isset($_GET['id']))
    document.addEventListener("DOMContentLoaded", function(event) {

    window.scrollTo(0,document.body.scrollHeight);
  });
    @endif


    let paginate = '1';
    $(document).on("click", '.page-link',function(event) {
        event.preventDefault();

        let slug = $('.nav-item').find('.active').attr('data-slug');

        // console.log($(this).attr('rel') == 'next');
        if ($(this).attr('rel') == 'next') {
            paginate = parseInt(paginate) + 1;
        }
        else if ($(this).attr('rel') == 'prev') {
            paginate = parseInt(paginate) - 1;
        }
        else {

            paginate = $(this).text();
        }

        // console.log(paginate);

        var data = {};
        data['paginate'] = paginate;

        if (slug != 'all') {
            data['category'] = [slug];
        }
        // console.log(data);
        $.ajax({
            url: "/api/productss?page="+paginate,
            method: "GET",
            data: data,
            success: function (data) {
               $('#your-class').html(data);
               $('body, html').animate({
                scrollTop: $(".your-class-parent").offset().top
                }, 600);
            //    $('.your-class-parent').focus();
            }
        });
    });


    function showTabProduct(elem) {
        // var id = $(elem).attr("id");
        // var slug = id.split("-")[0].toLowerCase();
        var slug = elem.toLowerCase();
        var data = {}
        if (slug != 'all') {
            data['category'] = [slug];
        }
        data['auth'] = '{{auth()->check()}}';

        data['user'] = '{{auth()->check()?auth()->user()->is_consultant:''}}';
        // console.log(data);
        $.ajax({
            url: "/api/productss",
            method: "GET",
            data: data,
            success: function (data) {
               $('#your-class').html(data);
            }
        });

    }

    function addToCart(id){
        //if(Auth::check() && Auth()->user()->consultant_id ==null)
        // if(!Auth::check())
        // errortoast('Please Become Consultant To Use This Feature!');
        // window.location = '/login';

            // else
        @if(Auth::check())
        $.ajax({
            url: "{{ route('add.to.cart') }}",
            method: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}",

            },
            success: function (data) {
                if (data.status == 1) {
                    $('#cart-quantity').text(data.quantity);
                    successtoast(data.message);

                }
                else if (data.status == 2) {
                    errortoast(data.message);

                }
                else {
                    errortoast('something went wrong');
                }
            },
            error: function (error) {
                errortoast('something went wrong');

            }
        });
        @else
        window.location = '/register';
        @endif
        // endif
    }
    $("section.productsec .nav-link").click(function(){

        $("a.nav-link").removeClass("active");
        $(this).addClass("active");
      });
     </script>



     @endsection
