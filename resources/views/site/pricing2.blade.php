@extends('layout.site.app')
@section('title', 'Contact Us')

<style>

div#based {
    text-align: center;
    box-shadow: 0px 0px 15px 0px rgb(0 0 0 / 6%);
    padding: 15px;
}

</style>


@section('content')


<div class="container" >

    <h1 class="py-5 text-center">All my prices are based on Angel Numbers</h1>
    <div class="row pb-5">
        <div class="col-12 col-lg-3 col-md-3" id="based">

            <h3 class="mt-2">All Earrings </h3>
            <hr/>
            <p>You pay $3.33 wholesale</p>
            <p>You sell for $4.44 retail</p>
            <p>You profit $1.11</p>
        </div>
        <div class="col-12 col-lg-3 col-md-3" id="based">

            <h3 class="mt-2">All Bracelets </h3>
            <hr/>
            <p>You pay $5.55 wholesale </p>
            <p>You sell for $8.88 retail</p>
            <p>You profit $3.33</p>
        </div>
        <div class="col-12 col-lg-3 col-md-3" id="based">
            <h3 class="mt-2">All Necklaces </h3>
            <hr/>
            <p>You pay $5.55 wholesale</p>
            <p>You sell for $8.88 retail</p>
            <p>You profit $3.33</p>

        </div>
        <div class="col-12 col-lg-3 col-md-3" id="based">
            <h3 class="mt-2">All Sets </h3>
            <hr/>
            <p>You pay $9.99 Wholesale</p>
            <p>You sell for $14.44 retail</p>
            <p>You profit $4.44</p>

        </div>

    </div>

</div>


@endsection


@section('afterScript')
@endsection
