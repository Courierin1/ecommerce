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
                        <h2>SITE SETTING</h2>
                    </div>
                    <div class="card-body py-4">
                        <form action="{{route('update.siteSettings')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Comission %</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="{{$setting->overall_comission}}" name="comission" id="comission"/>
                                </div>
                                @if ($errors->has('comission'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('comission') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Shipping</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="{{$setting->shipping}}" name="shipping" id="shipping"/>
                                </div>
                                @if ($errors->has('shipping'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('shipping') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Mode</label>
                                <div class="col-sm-10">
                                <input id="mode" type="text" class="form-control" value="{{$setting->paypal_mode}}" name="mode" >
                            @if ($errors->has('mode'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('mode') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                <input id="username" type="text" class="form-control" value="{{$setting->paypal_sandbox_api_username}}" name="username" >
                            @if ($errors->has('username'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                <input id="password" type="text" class="form-control" value="{{$setting->paypal_sandbox_api_password}}" name="password" >
                            @if ($errors->has('password'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Secret</label>
                                <div class="col-sm-10">
                                <input id="secret" type="text" class="form-control" value="{{$setting->paypal_sandbox_api_secret}}" name="secret" >
                            @if ($errors->has('secret'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('secret') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Currency</label>
                                <div class="col-sm-10">
                                <input id="curr" type="text" class="form-control" value="{{$setting->paypal_currency}}" name="curr" >
                            @if ($errors->has('curr'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('curr') }}</strong>
                                    </span>
                                @endif
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

@endsection

@section('afterScript')

@endsection