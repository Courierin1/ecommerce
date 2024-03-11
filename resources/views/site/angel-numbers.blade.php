@extends('layout.site.app')
@section('title', 'Bible Verses')

@section('content')
<style>
    .accordion__body span{
        font-size: 18px !important
    }
    .accordion__body p{
        color: #6d0018;
        font-size: 20px !important
    }
    .accordion__title.active,main.site-wrapper h2{
        color: #6d0018
    }
</style>
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
    <h2 style="text-align: center; background: none; padding-bottom: 0; color : #d00;">It looks like you haven't selected a Consultant yet!</h2>
<p style="text-align: center; color:#551d7c; font-size: 18px"><span>...were you just wanting to browse or were you looking to shop and pick a Consultant to shop under?</span></p>
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
 <!-- Banner Section -->
 <section class="innerbanner angel-banner">

        <!-- <div class="inner-image">
            <img src="images/angel-banner2.jpg" class="img-fluid w-100" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="innercaption">
                        <h3>All my prices are based off of <br> Angel Numbers and here are their meanings</h3>
                    </div>
                </div>
            </div>
        </div> -->
    </section>
    <!-- Banner Section -->

    <!-- product Category -->
    <div class="yellow-bg bg-img">
        <main class="site-wrapper container py-5">
            <!-- <h3 class="text-center">All my prices are based off of Angel Numbers and here are their meanings</h3> -->
            <div class="accordion yellow-bg ">
                <div class="accordion__item border-red">
                    <h2 class="accordion__title active">$4:44</h2>
                    <h4 class="accordion__title active"></h4>
                    <div class="accordion__body">
                        <p>
                            <span>Genesis 44:4AMP</span> <br>
                            “When they had left the city, and were not yet far away, Joseph said to his steward, “Get up, follow after the men; and when you overtake them, say to them, ‘Why have you repaid evil [to us] for good [paid to you]?”
                        </p>
                        <p class="my-3">
                            <span>Numbers 4:44 AMP</span> <br>
                            “the men who were numbered by their families were 3,200.”
                        </p>
                        <p class="my-3">
                            <span>Deuteronomy 4:44 AMP</span> <br>
                            “This is the law which Moses placed before the sons of Israel;”
                        </p>
                        <p class="my-3">
                            <span>2 Kings 4:44 AMP</span> <br>
                            “So he set it before them, and they ate and left some, in accordance with the word of the Lord.”
                        </p>
                        <p class="my-3">
                            <span>Psalms 44:4 AMP</span> <br>
                            “You are my King, O God; Command victories and deliverance for Jacob (Israel).”
                        </p>
                        <p class="my-3">
                            <span>Isaiah 44:4 AMP</span> <br>
                            “And they will spring up among the grass Like willows by the streams of water.’”
                        </p>
                        <p class="my-3">
                            <span>Jeremiah 44:4 AMP</span> <br>
                            “You are my King, O God; Command victories and deliverance for Jacob (Israel).”
                        </p>
                        <p class="my-3">
                            <span>Ezekiel 44:4 AMP</span> <br>
                            “Then He brought me by way of the north gate to the front of the house; I looked, and behold, the glory and brilliance of the Lord filled the house of the Lord, and I fell face downward.”
                        </p>
                        <p class="my-3">
                            <span>Luke 4:44 AMP</span> <br>
                            “So He continued preaching in the synagogues of Judea [the country of the Jews, including Galilee].”
                        </p>
                        <p class="my-3">
                            <span>John 4:44 AMP</span> <br>
                            “For Jesus Himself declared that a prophet has no honor in his own country.”
                        </p>

                    </div>
                </div>
                <!-- 	END Item -->
                <div class="accordion__item border-red">
                    <h2 class="accordion__title">$8:88</h2>
                    <div class="accordion__body">

                        <p class="my-3">
                            <span>Psalms 88:8 NIV</span> <br>
                            “You have taken from me my closest friends and have made me repulsive to them. I am confined and cannot escape;”
                        </p>
                    </div>
                </div>
                <!-- 	END Item -->
                <div class="accordion__item border-red">
                    <h2 class="accordion__title">$14:44</h2>
                    <div class="accordion__body">
                        <p class="my-3">
                            <span>Leviticus 14:44 NIV</span> <br>
                            “the priest is to go and examine it and, if the mold has spread in the house, it is a persistent defiling mold; the house is unclean.”
                        </p>
                        <p class="my-3">
                            <span>Numbers 14:44 NIV</span> <br>
                            “Nevertheless, in their presumption they went up toward the highest point in the hill country, though neither Moses nor the ark of the Lord’s covenant moved from the camp.”
                        </p>
                        <p class="my-3">
                            <span>1 Samuel 14:44 NIV</span> <br>
                            “Saul said, “May God deal with me, be it ever so severely, if you do not die, Jonathan.””
                        </p>
                        <p class="my-3">
                            <span>Mark 14:44 NIV</span> <br>
                            “Now the betrayer had arranged a signal with them: “The one I kiss is the man; arrest him and lead him away under guard.”
                        </p>
                    </div>
                </div>
                <!-- 	END Item -->
                {{-- <div class="accordion__item">
                    <h2 class="accordion__title">Angel number 888</h2>
                    <div class="accordion__body">
                        <p>Angel number 888 is a sure sign of financial abundance and material wealth in action. The number 8 alone is a symbol of prosperity as well as infinity, indicating that financial wealth is infinitely available to all of us. Once you
                            understand that the flow of abundance is unlimited, you will be amazed by how your life unfolds The Angel Number 888 =Abundance! 888 is a signal from the angels and the realms of spirit that prosperity in abundance is yours, and
                            you're on the right track to bring yourself into alignment with it. When the angels show you 888 it may also mean that you've reached a level of completion in one or more areas in your life.
                        </p>
                    </div>
                </div> --}}
                <!-- 	END Item -->
                {{-- <div class="accordion__item">
                    <h2 class="accordion__title">Angel number 999</h2>
                    <div class="accordion__body">
                        <p>It is time to be ready for a new chapter in your life, and the number 999 is the key. Angel number 999 signifies that angels have recognized your heart and your experience, therefore they will assist you in overcoming any challenges
                            that may arise in the near future. Getting rid of your fear is all you need to do.
                        </p>
                    </div>
                </div> --}}
                <!-- 	END Item -->
                {{-- <div class="accordion__item">
                    <h2 class="accordion__title">Angel number 4444</h2>
                    <div class="accordion__body">
                        <p>The angel number 4444 in the Bible bring us a message of material completeness. It is all about wholeness. In the Bible the angel number 4444 represents those books that talk about Jesus, namely Matthew, Mark, Luke and John. That said
                            the meaning of 4444 then is that of a new life with Christ.
                        </p>
                    </div>
                </div> --}}
                <!-- 	END Item -->
                {{-- <div class="accordion__item">
                    <h2 class="accordion__title">Angel number 44444</h2>
                    <div class="accordion__body">
                        <p>Angel number 44444 is five-fold the energy of angel number 4 which means the message is intensified. 44444 angel number is an angelic message telling you to take action. Pay attention to these angelic messages and know their meanings
                            as they will help you greatly in achieving your dreams or life purpose. When noticing the angel number 44444 appearing, take notice of the thoughts you had right at that time as it will help you decipher the meaning of number 44444
                            better. Whether you’re feeling on the fence of your relationship, or perhaps not sure about what career path to choose, or you are feeling beaten down by life in general. Have faith that everything will be OK and your time will
                            come.
                        </p>
                    </div>
                </div> --}}
                <!-- 	END Item -->
            </div>
            <!-- 	END Accordion -->
        </main>
    </div>
    <!-- product Category -->
@endsection


@section('afterScript')
@endsection
