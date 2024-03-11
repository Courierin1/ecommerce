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
                        <h2>EMAIL NOTIFICATION</h2>
                    </div>
                    <div class="card-body py-4">
                        <form action="{{route('admin.email_notification_update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="prescription_main_parent">
                                <div class="email_parent">
                                    @forelse($email_notifications as $notification)
                                    <div class="email_row border p-2 mb-2">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <label>Notification Email<span class="text-danger">*</span></label>
                                                <input type="email" placeholder="Notification Email" class="form-control" 
                                                value="{{ $notification->email }}" name="email[]" required>
                                            </div>
                                            <div class="col-md-1 text-center">
                                                <a href="javascript:;" class="delete_row">
                                                    x
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
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
                                    @endforelse
                                </div>
                                <div class="text-right" style="text-align: right;">
                                    <a href="javascript:;" class="add_email btn btn-sm btn-success">Add New</a>
                                </div>
                            </div>
                           
                            <div class="data-target"></div>
                            <br/>
                            <br/>
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