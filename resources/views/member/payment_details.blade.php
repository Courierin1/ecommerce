@extends('layout.member.app')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
<style>
    #myTable tbody tr td{
        color: #000;
    }
    .btn-edit_member{
        background-color: #F08F21;
        color: #ffff;
        padding: 5px 10px;
        border: 1px solid #F08F21;
    }
    .btn-edit_member:hover{
        background-color: #fff;
        color: #F08F21;
        border: 1px solid #F08F21;
    }
    #payment_form h4{
        color: #000;
    }
</style>
@section('content')

<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-6 mb-3">
                <h2 class="text-dark">
                    Payment History
                </h2>
                  
            </div>
            <div class="col-md-6 mb-3 d-flex justify-content-end">
               <a class="btn btn-edit_member" href = "{{route('user.edit_payments')}}">Edit Payment</a>   
            </div>
            <div class="col-md-12">
                <form action="" id="payment_form">
                    <div class="col-md-12">
                        <select class="form-control" id="payment_method" onchange="onchange1()" disabled>
                            <option >Select Payment Method</option>
                            <option value="1" selected>Payment Via Stripe / Paypal</option>
                            <option value="2">Direct Bank Transfer</option>
                            <option value="3">Pay Via Check</option>
                            
                        </select>
                    </div>
                    <div class="my-3" id="paypal">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="my-2">Pay Via Paypal / Stripe</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_name">Card Holder Name</label>
                                    <input type="text" class="form-control" id="c_name" disabled>
                                   
                                </div>                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_num">Card Number</label>
                                    <input type="number" class="form-control" id="c_num" disabled>
                                   
                                </div>                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cvv">CVV</label>
                                    <input type="number" class="form-control" id="cvv" disabled>
                                   
                                </div>                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exp">Card Holder Name</label>
                                    <input type="number" class="form-control" id="exp" disabled>
                                   
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="my-3 d-none" id="bank">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="my-2">Pay Via Bank Transfer</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_name">Account Title</label>
                                    <input type="text" class="form-control" id="c_name" disabled>
                                   
                                </div>                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_num">Bank Name</label>
                                    <input type="number" class="form-control" id="c_num" disabled>
                                   
                                </div>                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cvv">Account Number</label>
                                    <input type="number" class="form-control" id="cvv" disabled>
                                   
                                </div>                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="my-3 d-none" id="check">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="my-2">Pay Via Check</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_name">Account Title</label>
                                    <input type="text" class="form-control" id="c_name" disabled>
                                   
                                </div>                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_num">Bank Name</label>
                                    <input type="number" class="form-control" id="c_num" disabled>
                                   
                                </div>                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cvv">Check Number</label>
                                    <input type="number" class="form-control" id="cvv" disabled>
                                   
                                </div>                                
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
<script>
   let table = new DataTable('#myTable', {
    responsive: true,

});
</script>
<script>
    let payment_method = document.getElementById("payment_method");
    let paypal = document.getElementById('paypal')
    let bank = document.getElementById('bank')
    let check = document.getElementById('check')
    // console.log(payment_method.value)
    function change1(){
        paypal.classList.remove('d-none')
        bank.classList.add('d-none')
        check.classList.add('d-none')
    }
    function change2(){
        paypal.classList.add('d-none')
        bank.classList.remove('d-none')
        check.classList.add('d-none')
    }
    function change3(){
        paypal.classList.add('d-none')
        bank.classList.add('d-none')
        check.classList.remove('d-none')
    }
    function onchange1(){
        if(payment_method.value == 1){
        change1()
    }
    else if(payment_method.value ==2){
        change2()
    }
    else if(payment_method.value == 3){
        change3()
    }
    }
</script>
@endsection
