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
</style>
@section('content')

<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h2 class="text-dark">
                    Payment History
                </h2>
                  
            </div>
            <!-- <div class="col-md-6 mb-3 d-flex justify-content-end">
               <a class="btn btn-edit_member" href = "{{route('user.edit_payments')}}">Edit Payment</a>   
            </div> -->
            <div class="col-md-12">
                <table id="myTable" class="display cell-border hover">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Order Id</th>
                            <th>Name Against Transaction</th>
                            <th>Transaction Id</th>
                            
                            <th>Transaction Medium</th>
                            <th>Transaction Amount</th>
                            <th>Date Of Transaction</th>
                            <th>Transaction Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>1656697371</td>
                            <td>Test</td>
                            <td>
                                1234546
                            </td>
                            
                            <td>
                                <p>Bank Transfer</p>
                            </td>
                            <td>
                                <p><strong>$244.44</strong></p>
                            </td>
                            <td>
                                <p>2/05/2023</p>
                            </td>
                            <td>
                                <p class="text-success">Success</p>
                            </td>
                            <td class="text-center">
                                <p><i class="fa-solid fa-trash text-danger "></i></p>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>1656697854</td>
                            <td>Product</td>
                            <td>
                                1234546
                            </td>
                            
                            <td>
                                <p>Check</p>
                            </td>
                            <td>
                                <p><strong>$44.44</strong></p>
                            </td>
                            <td>
                                <p>05/01/2023</p>
                            </td>
                            <td>
                                <p class="text-danger">Declined</p>
                            </td>
                            <td class="text-center">
                                <p><i class="fa-solid fa-trash text-danger "></i></p>
                            </td>
                        </tr>

                    
                        
                    </tbody>
                </table>
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
@endsection
