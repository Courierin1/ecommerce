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
                    <div class="card-header py-4">
                        <h2 class="w-100 text-center">Import Csv</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-default text-dark">
                    <div class="card-header p-0">
                    </div>
                    <div class="card-body pt-4">
                       <form action="{{route('admin.import.csv')}}" method="post" enctype="multipart/form-data" role="form">
                        @csrf
                        <label for="">Product CSV</label>
                        <input type="file" name="csv" id="csv" class="form-control"/>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Upload</button>
                    </form>

                   
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
            <label class="text-dark">Sample Product Csv</label>
            <a class="btn btn-primary ml-3" href="{{asset('sample_product.xlsx')}}" download>Sample Product Csv</a>

            </div>
        </div>
    </div>
</div>

@endsection

@section('afterScript')
<script src="{{ asset('admin_assets/assets/plugins/data-tables/jquery.datatables.min.js')}}"></script>
<script src="{{ asset('admin_assets/assets/plugins/data-tables/datatables.bootstrap4.min.js')}}"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#basic-data-table").DataTable({
            dom: '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
            order: [[4, 'desc']],
        });
    });
</script>
<script>
    function generateSlug(str){
        str = str.toLowerCase();
        str = str.replace(/ /g,'-').replace(/[-]+/g, '-').replace(/[^\w-]+/g,'');
        return str;
    }
    $(".category_name").keyup(function(){
        var Text = $(this).val();
        var id = $(this).attr('id').split("-").pop();
        $(`#category_slug-${id}`).val(generateSlug(Text));    
    });

    // $(".collection_name").keyup(function(){
    //     var Text = $(this).val();
    //     var id = $(this).attr('id').split("-").pop();
    //     console.log(id);
    //     $(`#slug-${id}`).val(generateSlug(Text));    
    // });
    $(".custom-select option").each(function() {
        $(this).siblings('[value="'+ this.value +'"]').remove();
    });

</script>
@endsection