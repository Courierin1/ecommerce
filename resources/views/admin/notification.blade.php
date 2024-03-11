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
            <table class="mt-5">
                    <tbody>

                        @forelse($notifications as $notification)
                        <tr class="border-bottom text-dark">
                            <td width="5%" class="ps-4">
                                <a href="javascript:;" 
                                data-href="{{ route('notification_destroy', $notification->id)  }}"
                                class="text-xs text-dark font-weight-bold m-4 d-inline-block delete_notification">
                                x
                                </a>
                            </td>
                            <td width="60%" class="text-left">
                                <p class="text-xs  mb-0">{{ $notification->message }}</p>
                            </td>
                            <td width="20%" class="text-left">
                                <span class="text-secondary text-xs ">
                                    {{ \Carbon\Carbon::parse($notification->created_at)->format('d M, Y h:i A') }}
                                </span>
                            </td>
                            <td width="10%">
                            <a href="javascript:;" 
                                data-href="{{ route('notification_destroy', $notification->id)  }}" 
                                class="btn btn-danger mx-1 mark_as_read">
                                Mark as read
                            </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No Records Found</td>
                        </tr>
                        @endforelse

                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>

@endsection

@section('afterScript')
<script>
        $(document).on('click', '.mark_as_read', function (e) {
            e.preventDefault();
            var href = $(this).attr('data-href');
            var this_el = $(this);

            $.ajax({
                type: 'POST',
                url: href,
                data: {
                    _token: $("meta[name='csrf-token']").attr("content"),
                },
                success: function (data) {
                    // console.log(data);
                    if (data.code == '200') {
                        successtoast(data.message);
                        $(this_el).hide();
                    }
                    else {
                        errortoast(data.message);
                    }
                }
            });
        });
        $(document).on('click', '.delete_notification', function (e) {
            e.preventDefault();
            var href = $(this).attr('data-href');
            var this_el = $(this);

            $.ajax({
                type: 'POST',
                url: href,
                data: {
                    _token: $("meta[name='csrf-token']").attr("content"),
                },
                success: function (data) {
                    // console.log(data);
                    if (data.code == '200') {
                        successtoast(data.message);
                        $(this_el).closest('tr').remove();
                    }
                    else {
                        errortoast(data.message);
                    }
                }
            });
        });

    </script>
@endsection