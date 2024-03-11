@extends('layout.admin.app')


@section('content')
<div class="content-wrapper">
    <div class="content topsCategory">
        <div class="row">
            <div class="col-lg-12">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p><strong>Errors!</strong>
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                    </p> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="card card-default text-dark">
                    <div class="card-header mainHeading">
                        <h2>Account Setting</h2>
                    </div>
                    <div class="card-body py-4">
                        <form action="{{route('admin.update_profile')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="">UserName*</label>
                                    <input type="text" name="user_name" value="{{ old('user_name', $user->user_name) }}"
                                    class="form-control" placeholder="UserName" required>
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <label for="">Email*</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="form-control" placeholder="Email" required>
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <label for="">Name*</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="form-control" placeholder="Name" required>
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                    class="form-control" placeholder="Phone Number">
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <label for="">Address</label>
                                    <input type="text" name="address" value="{{ old('address', $user->address) }}"
                                    class="form-control" placeholder="Address">
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <label for="">Password</label>
                                    <input type="password" name="password" value="{{ old('password') }}"
                                    class="form-control" placeholder="Password">
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirm-password" value="{{ old('confirm-password') }}"
                                    class="form-control" placeholder="Confirm Password">
                                </div> 
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-sm-10 offset-sm-2 text-right">
                                    <button type="submit" class="btn btn-primary">
                                       SUBMIT
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

<div class="email_add_new_row d-none">
        <div class="email_row border p-2 mb-2">
            <div class="row">
                <div class="col-md-11">
                    <label>Notification Email<span class="text-danger">*</span></label>
                    <input type="email" placeholder="Notification Email" class="form-control" name="email[]" required>
                </div>
                <div class="col-md-1 text-center">
                    <a href="javascript:;" class="delete_row">
                        x
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('afterScript')

<script>

function count_email_rows() {
    if($('.email_row').length < 3) {
        $('.delete_row').addClass('d-none');
    } else {
        $('.delete_row').removeClass('d-none');
    }
    if($('.email_row').length > 3) {
        $('.add_email').addClass('d-none');
    } else {
        $('.add_email').removeClass('d-none');
    }
}

count_email_rows();
$(document).on('click', '.add_email', function (e) {
    $('.email_parent').append($('.email_add_new_row').html());

    count_email_rows();
});

$(document).on('click', '.delete_row', function (e) {
    $(this).closest('.email_row').remove();
    
    count_email_rows();
});



</script>
@endsection