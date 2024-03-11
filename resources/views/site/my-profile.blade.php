@extends('layout.site.app')
@section('title', 'Dashboard')

@section('content')
<!-- Banner Section -->
<section class="innerbanner">
    @if($errors->any())
    <div class="alert alert-danger">
        <p><strong>Opps Something went wrong</strong></p>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif
    <div class="inner-image">
        <img src="images/about.png" class="img-fluid w-100" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="innercaption">
                    <h2>Profile</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section -->

<!-- Profile Sec -->
<section class="profile-sec py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
                <div class="profile">
                    <h3>My Profile (#{{Auth()->user()->id}} with #{{Auth()->user()->unique_id}})</h3>
                    <div class="myconsultant py-4">

                        @if(isset(Auth()->user()->consultant))
                        <div class="sponsor-box">
                            <h5 class="font-weight-bold">My Consultant</h5>
                            <p class="spn-name">{{isset(Auth()->user()->consultant) ? Auth()->user()->consultant['name'] : ''}}</p>

                            <img class="spn-image img-fluid" src="{{isset(Auth()->user()->consultant['image']) ? Auth()->user()->consultant['image'] : '/images/shellie-logo.jpg'}}" alt="">
                        </div>


                        @else
                        <li style="color:red;font-size:20px;font-weight:bold;text-align:center">
                            No Consultant Yet
                        </li>
                        @endif
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="order-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="home" aria-selected="true">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">My Personal Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">My Address</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="order-tab">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="u-table-res">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Order #</th>
                                                    <th>Total</th>
                                                    <th>Order Status</th>
                                                    <th>Payment Status</th>
                                                    <th>Date Purchased</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                <tr>
                                                    <td><a class="navi-link" href="#" data-toggle="modal" data-target="#orderDetails">{{$order->order_id}}</a></td>
                                                    <td>
                                                        ${{$order->grand_total}}

                                                    </td>
                                                    <td>
                                                        <span class="text-info">{{$order->status==1? 'Active' : 'Pending'}}</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-danger">{{$order->payment_status==1? 'Paid' : 'UnPaid'}}</span>
                                                    </td>

                                                    <td>{{date('D/M/Y',strtotime($order->created_at))}}</td>
                                                    <td>
                                                        <a href="{{route('order.detail',$order->order_id)}}" target="_blank" class="btn btn-info btn-sm">Details</a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        @if ($orders->hasPages())
                                        <div class="pagination-wrapper">
                                            {{ $orders->links() }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <h3 class="mt-5 font-weight-bold text-center">Affiliate Orders</h3>
                                    <div class="u-table-res">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Order #</th>
                                                    <th>Total</th>
                                                    <th>My Profit</th>
                                                    <th>Order Status</th>
                                                    <th>Payment Status</th>
                                                    <th>Date Purchased</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($aorders as $aorder)
                                                <tr>
                                                    <td><a class="navi-link" href="#" data-toggle="modal" data-target="#orderDetails">{{$aorder->order_id}}</a></td>
                                                    <td>
                                                        ${{$aorder->grand_total}}

                                                    </td>
                                                    <td>
                                                        ${{$aorder->sponsor_comission ?? 0.00}}

                                                    </td>
                                                    <td>
                                                        <span class="text-info">{{$aorder->status==1? 'Active' : 'Pending'}}</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-danger">{{$aorder->payment_status==1? 'Paid' : 'UnPaid'}}</span>
                                                    </td>

                                                    <td>{{date('D/M/Y',strtotime($aorder->created_at))}}</td>
                                                    <td>
                                                        <a href="{{route('order.detail',$aorder->order_id)}}" target="_blank" class="btn btn-info btn-sm">Details</a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        @if ($aorders->hasPages())
                                        <div class="pagination-wrapper">
                                            {{ $aorders->links() }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="info">
                                        <h3>Edit My Profile Information</h3>
                                        <form action="{{route('profile.personal')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">First Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" value="{{isset(Auth()->user()->detail,Auth()->user()->detail['first_name']) ? Auth()->user()->detail['first_name'] : old('first_name')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Last Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" value="{{isset(Auth()->user()->detail,Auth()->user()->detail['last_name']) ? Auth()->user()->detail['last_name'] : old('last_name')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Social Security Number<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Social Security Number" name="ssn" id="ssn" value="{{isset(Auth()->user()->detail,Auth()->user()->detail['ssn']) ? Auth()->user()->detail['ssn'] : old('ssn')}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Profile Picture</label>
                                                <input type="file" id="image" name="image" class="form-control" />
                                                @if(isset(Auth()->user()->image))
                                                <img src="{{Auth()->user()->image}}" alt="Old Profile Picture" width="250" height="300">
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-success ml-0">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 address-box">
                                    <h4 class="font-weight-bold">Address</h4>
                                        <li>
                                            <address>
                                                <span class="d-block">{{Auth()->user()->address}}</span>
                                                <span class="d-block">{{Auth()->user()->city}}, {{Auth()->user()->state}}, {{Auth()->user()->country}}</span>
                                                <span class="d-block">{{Auth()->user()->zip}}</span>
                                            </address>

                                        </li>
                                        <!-- <button class="btn" type="submit">Update</button> -->
                                    </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    
                                    <div class="new_address">
                                        <h2>Billing Address</h2>
                                        <form action="{{route('profile.address')}}" method="post" enctype="multipart/form">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Address" name="street_1" value="{{isset(Auth()->user()->detail,Auth()->user()->detail['bill_street_1']) ? Auth()->user()->detail['bill_street_1'] : old('street_1')}}">
                                                <input type="hidden" name="bill" id="bill"/>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Address (Line2)" name="street_2" value="{{isset(Auth()->user()->detail,Auth()->user()->detail['bill_street_2']) ? Auth()->user()->detail['bill_street_2'] : old('street_2')}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Zip Code" name="postal_code" value="{{isset(Auth()->user()->detail,Auth()->user()->detail['bill_postal_code']) ? Auth()->user()->detail['bill_postal_code'] : old('postal_code')}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-8 col-12">
                                                    <input type="text" class="form-control" placeholder="City" name="city" value="{{isset(Auth()->user()->detail,Auth()->user()->detail['bill_city']) ? Auth()->user()->detail['bill_city'] : old('city')}}">
                                                </div>
                                                <div class="col-sm-4 col-12">
                                                    <input type="text" class="form-control" placeholder="State" name="state" value="{{isset(Auth()->user()->detail,Auth()->user()->detail['bill_state']) ? Auth()->user()->detail['bill_state'] : old('state')}}">
                                                </div>
                                            </div>
                                            <div class="form-group mt-4">
                                                <select name="country" id="" class="form-control">
                                                   
                                                    <option value="" disabled selected>Select Country</option>
                                                    <option value="USA" {{isset(Auth()->user()->detail) && Auth()->user()->detail['bill_country']=='USA' ? 'selected' : (old('country')=='USA' ? 'selected' : '')}}>USA</option>
                                                </select>
                                            </div>
                                           
                                            <button type="submit" class="btn btn-success ml-0">Save</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    
                                    <div class="new_address">
                                        <h2>Shipping Address</h2>
                                        <form action="{{route('profile.address')}}" method="post" enctype="multipart/form">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Address" name="street_1" value="{{isset(Auth()->user()->detail,Auth()->user()->detail['ship_street_1']) ? Auth()->user()->detail['ship_street_1'] : old('street_1')}}">
                                                <input type="hidden" name="ship" id="ship"/>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Address (Line2)" name="street_2" value="{{isset(Auth()->user()->detail,Auth()->user()->detail['ship_street_2']) ? Auth()->user()->detail['ship_street_2'] : old('street_2')}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Zip Code" name="postal_code" value="{{isset(Auth()->user()->detail,Auth()->user()->detail['ship_postal_code']) ? Auth()->user()->detail['ship_postal_code'] : old('postal_code')}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-8 col-12">
                                                    <input type="text" class="form-control" placeholder="City" name="city" value="{{isset(Auth()->user()->detail,Auth()->user()->detail['ship_city']) ? Auth()->user()->detail['ship_city'] : old('city')}}">
                                                </div>
                                                <div class="col-sm-4 col-12">
                                                    <input type="text" class="form-control" placeholder="State" name="state" value="{{isset(Auth()->user()->detail,Auth()->user()->detail['ship_state']) ? Auth()->user()->detail['ship_state'] : old('state')}}">
                                                </div>
                                            </div>
                                            <div class="form-group mt-4">
                                                <select name="country" id="" class="form-control">
                                                   
                                                    <option value="" disabled selected>Select Country</option>
                                                    <option value="USA" {{isset(Auth()->user()->detail) && Auth()->user()->detail['ship_country']=='USA' ? 'selected' : (old('country')=='USA' ? 'selected' : '')}}>USA</option>
                                                </select>
                                            </div>
                                           
                                            <button type="submit" class="btn btn-success ml-0">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Profile Sec -->

@endsection
@section('afterScript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
<script>

$(document).ready(function () {

$("input[name='ssn']").inputmask('999-99-9999');

});


</script>
@endsection