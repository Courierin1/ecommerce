@extends('layout.member.app')
<link
    rel="stylesheet"
    href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css"
/>
<style>
    #myTable tbody tr td {
        color: #000;
    }
    .btn-edit_member {
        background-color: #f08f21;
        color: #ffff;
        padding: 5px 10px;
        border: 1px solid #f08f21;
    }
    .btn-edit_member:hover {
        background-color: #fff;
        color: #f08f21;
        border: 1px solid #f08f21;
    }
    #payment_form h4 {
        color: #000;
    }
</style>
@section('content')

<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-6 mb-3">
                <h2 class="text-dark">Account Information</h2>
            </div>
            <div class="col-md-6 mb-3 d-flex justify-content-end">
                <!-- <a
                    class="btn btn-edit_member"
                    href="{{ route('user.edit_accounts') }}"
                    >Edit Information</a
                > -->
            </div>
            <div class="col-md-12">
            <form action="{{route('user.store_account')}}" method="POST" id="information" >
                @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    value="{{$user->name}}"
                                    name="name"

                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    value="{{$user->user_name }}"
                                    name="user_name"

                                />
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="Email">Email Address</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="Email"
                                    name="email"
                                    value="{{$user->email}}"
readonly
                                />
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input
                                    type="tel"
                                    class="form-control"
                                    id="phone"
                                    value="{{$user->phone}}"
                                    name="phone"

                                />
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="Address">Complete Address</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="Address"
                                    value="{{$user->address}}"
                                    name="address"

                                />
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="Zip">Zip Code</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="Zip"
                                    value="{{$user->zip}}"
                                    name="zip"

                                />
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="City">City</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="City"
                                    value="{{$user->city}}"
                                    name="city"

                                />
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="State">State</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="State"
                                    value="{{$user->state}}"
                                    name="state"

                                />
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="Country">Country</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="Country"
                                    value="{{$user->country}}"

                                    name="country"
                                />
                            </div>
                        </div>


 <div class="col-md-8 d-flex justify-content-end align-items-center">
                            <div>
                                <input type="submit" value="Submit" class="btn">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
<script>
    let table = new DataTable("#myTable", {
        responsive: true,
    });
</script>
<script>
    let payment_method = document.getElementById("payment_method");
    let paypal = document.getElementById("paypal");
    let bank = document.getElementById("bank");
    let check = document.getElementById("check");
    // console.log(payment_method.value)
    function change1() {
        paypal.classList.remove("d-none");
        bank.classList.add("d-none");
        check.classList.add("d-none");
    }
    function change2() {
        paypal.classList.add("d-none");
        bank.classList.remove("d-none");
        check.classList.add("d-none");
    }
    function change3() {
        paypal.classList.add("d-none");
        bank.classList.add("d-none");
        check.classList.remove("d-none");
    }
    function onchange1() {
        if (payment_method.value == 1) {
            change1();
        } else if (payment_method.value == 2) {
            change2();
        } else if (payment_method.value == 3) {
            change3();
        }
    }
</script>
@endsection
