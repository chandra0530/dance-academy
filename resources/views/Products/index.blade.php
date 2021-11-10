@extends('admin.layouts.admin')
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
                            <h2 class="content-header-title float-left mb-0">Products</h2>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.partials.message')
            <div class="content-body">
                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <section id="basic-input-groups">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Search & Filter</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form action="">
                                                    <div class="row">

                                                        <div class="col-md-4 col-12 mb-1">
                                                            <fieldset>
                                                                <div class="input-group">
                                                                    <select class="form-control" name="category_id"
                                                                            id="">
                                                                        <option value="0" selected disabled>Select
                                                                          Sub  Category
                                                                        </option>
                                                                        @foreach($categories as $category)
                                                                            <option
                                                                                value="{{ $category->id }}">{{ $category->subcategory_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-4 col-12 mb-1">
                                                            <fieldset>
                                                                <div class="input-group">
                                                                    <input type="text" name="product_name"
                                                                           class="form-control"
                                                                           placeholder="Product name"
                                                                           aria-describedby="basic-addon2">
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-2 col-12 mb-1">
                                                            <fieldset>
                                                                <div class="input-group">
                                                                    <button
                                                                        class="btn btn-primary waves-effect waves-light"
                                                                        type="submit"><i
                                                                            class="feather icon-search"></i>
                                                                    </button>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-2 col-12 mb-1">
                                                            <fieldset>
                                                                <div class="input-group">
                                                                    <a href="#"
                                                                       class="btn btn-round btn-success waves-effect waves-light"
                                                                       type="button"><i
                                                                            class="feather icon-database"></i> Export
                                                                        CSV</a>
                                                                </div>
                                                            </fieldset>
                                                        </div>

                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Products List</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Product Sub Category</th>
                                                <th>Product Thumbnail</th>
                                                <th>Actual Price</th>
                                                <th>Offer Price</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                                <tr>
                                                    <th scope="row">{{$product->name}}</th>
                                                    <th scope="row">{{$product->subcategory->subcategory_name}}</th>
                                                    <td><img src="{{$product->thumbnail}}"
                                                             style="height:50px;width:50px"></td>
                                                    <td>
                                                        {{$product->actual_price}}
                                                    </td>
                                                    <td>
                                                        {{$product->offer_price}}
                                                    </td>
                                                    <td>
                                                        <a href="product/{{$product->id}}"
                                                           class="btn btn-circle btn-warning"><i
                                                                class="fa fa-pencil"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete?')"
                                                           href="product/delete/{{$product->id}}"
                                                           class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection