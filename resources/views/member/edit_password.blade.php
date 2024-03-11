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
                <a
                    class="btn btn-edit_member"
                    href="{{ route('user.edit_accounts') }}"
                    >Edit Information</a
                >
            </div>
            <div class="col-md-12">
                <form action="{{route('user.change.password')}}" id="information" method="POST"
                oninput='c_pass.setCustomValidity(c_pass.value != pass.value ? "Passwords do not match." : "")'
                >
                @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="pass"
                                    name="pass"
                                    placeholder="********"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="c_pass">Confirm Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="c_pass"
                                    placeholder="********"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                               <input type="submit" value="Submit" class="btn btn-submit">
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
