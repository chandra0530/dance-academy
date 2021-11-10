@extends('admin.layouts.admin')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Product</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Add Product
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.partials.message')
            <div class="content-body">
                <!-- Bootstrap Select start -->
                <!-- Basic Select2 start -->
                <section class="basic-select2">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Product</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form enctype="multipart/form-data" method="POST"
                                              action="{{ route('product.store') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Product Name
                                                        </div>
                                                        <input type="text" class="form-control" name="product_name"
                                                               id="basicInput" placeholder="Enter product name">
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Actual Price
                                                        </div>
                                                        <fieldset>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                          id="basic-addon1">Rs</span>
                                                                </div>
                                                                <input type="number" step="0.01" class="form-control"
                                                                       name="actual_ammount"
                                                                       placeholder="Enter actual ammount"
                                                                       aria-describedby="basic-addon1">
                                                            </div>
                                                        </fieldset>
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Offer Price
                                                        </div>
                                                        <fieldset>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                          id="basic-addon1">Rs</span>
                                                                </div>
                                                                <input type="number" step="0.01" class="form-control"
                                                                       name="offer_amount"
                                                                       placeholder="Enter Offer ammount"
                                                                       aria-describedby="basic-addon1">
                                                            </div>
                                                        </fieldset>
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Photos <small>( 900 * 400 )Px</small>
                                                        </div>
                                                        <input type="file" multiple name="photos[]" class="form-control"
                                                               id="photos" placeholder="Select product images">
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Thumbnail <small>( 150 * 150 )Px</small>
                                                        </div>
                                                        <input type="file" class="form-control" name="thumbnail"
                                                               id="thumbnail" placeholder="Select product thumbnail">
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Website
                                                        </div>
                                                        <input type="text" class="form-control" name="website"
                                                               id="website" placeholder="Enter website url">
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Phone number
                                                        </div>
                                                        <input type="text" class="form-control" name="phone" id="phone"
                                                               placeholder="Enter contact number">
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Select Sub-Category
                                                        </div>
                                                        <div class="form-group">
                                                            <select class=" form-control" name="category_id">
                                                                @foreach($categories as $category)
                                                                    <option
                                                                        value="{{ $category->id }}">{{ $category->subcategory_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Select Attribute
                                                        </div>
                                                        <div class="form-group">
                                                            <select class="select2 form-control" id='choice_attributes'
                                                                    name="attributes[]" multiple="multiple">
                                                                @foreach($attributes as $attribute)
                                                                    <option
                                                                        value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <div id="customer_choice_options" class="col-sm-6 col-12">
                                                </div>
                                                <div id="sku_choice_options" class="col-sm-6 col-12">
                                                </div>

                                                <div class="col-sm-12 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Description
                                                        </div>
                                                        <textarea id="desc" name="desc"
                                                                  style="height: 200px; width: 100%"></textarea>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <button class="btn btn-primary btn-block waves-effect waves-light"
                                                    type="submit">
                                                Add Product
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Select2 end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#desc').summernote();
            $('#choice_attributes').on('change', function () {
                $('#customer_choice_options').html(null);
                $('#sku_choice_options').html(null);
                $.each($("#choice_attributes option:selected"), function () {
                    add_more_customer_choice_option($(this).val(), $(this).text());
                });
            });

            function add_more_customer_choice_option(i, name) {
                $('#customer_choice_options').append('' +
                    '<div class="row mb-3">' +
                    '<div class="col-8 col-md-3 order-1 order-md-0">' +
                    '<input type="hidden" name="choice_no[]" value="' + i + '">' +
                    '<input type="text" class="form-control" name="choice[]" value="' + name + '" placeholder="Choice Title" readonly>' +
                    '</div>' +
                    '<div class="col-12 col-md-7 col-xl-8 order-3 order-md-0 mt-2 mt-md-0">' +
                    '<input type="text" class="form-control" id="choice_options_' + i + '" name="choice_options_' + i + '[]" onChange="getProductCombinations()" placeholder="Enter choice values by comma" >' +
                    '</div>' +
                    '<div class="col-4 col-xl-1 col-md-2 order-2 order-md-0 text-right">' +
                    '<button type="button" onclick="delete_row(this)" class="btn btn-link btn-icon text-danger">' +
                    '<i class="fa fa-trash-o"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>');
            }

        });

        function delete_row(em) {
            $('#sku_choice_options').html(null);
            $(em).closest('.row').remove();
        }

        function getProductCombinations() {
            $('#sku_choice_options').html(null);
            var foo = $('#choice_attributes').val();
            var options = [];
            for (var i = 0; i < foo.length; i++) {
                var index=parseInt(foo[i]);
                var temp = $('#choice_options_' + index).val();
                console.log(temp);
                var test=temp.split(",");
                options.push(test);
            }
            $.ajax({
                type: "POST",
                url: '{{ route('products.sku_combination') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "options": options
                },
                success: function (data) {
                    console.log(data);
                    //    $('#sku_combination').html(data);
                    if (data.length > 1) {
                        for (var i = 0; i < data.length; i++) {
                            var combination = '';
                            for (var j = 0; j < data[i].length; j++) {
                                if (combination !== '') {
                                    combination += "-";
                                }
                                combination += data[i][j];
                            }


                            $('#sku_choice_options').append('' +
                                '<div class="row mb-3">' +
                                '<div class="col-8 col-md-3 order-1 order-md-0">' +
                                '<input type="text" class="form-control" name="combination[]" value="' + combination + '" placeholder="Choice Title" readonly>' +
                                '</div>' +
                                '<div class="col-12 col-md-7 col-xl-8 order-3 order-md-0 mt-2 mt-md-0">' +
                                '<input type="text" class="form-control" id="sku_combination_price_' + i + '" name="sku_combination_price_' + i + '" placeholder="Enter price for this variation" >' +
                                '</div>' +
                                '</div>');
                        }
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }

    </script>
@endpush