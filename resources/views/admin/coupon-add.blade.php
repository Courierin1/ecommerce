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
                        <h2>KITS</h2>
                    </div>
                    <div class="card-body py-4">
                        <form action="{{route('admin.coupon.store')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="code" id="code" placeholder="Coupon Code" value="{{old('code')}}"/>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Discount %</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="discount" name="discount" type="number" placeholder="0.00" value="{{old('discount')}}"/>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Expiry Date</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="expiry_date" name="expiry_date" type="date" value="{{old('expiry_date')}}"/>
                                </div>
                            </div>
                            
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                <input id="status" name="status" type="checkbox" value="1" {{old('status')==1 ? 'checked' : ''}} />
                                </div>
                            </div>
                            <div class="data-target"></div>
                            <br/>
                            <br/>
                            <div class="form-group row mt-2">
                                <div class="col-sm-10 offset-sm-2 text-right">
                                    <button type="submit" class="btn btn-primary w-100">
                                        ADD COUPON
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

@endsection

@section('afterScript')

@endsection