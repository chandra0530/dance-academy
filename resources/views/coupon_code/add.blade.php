@extends('admin')
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
                            <h2 class="content-header-title float-left mb-0">Coupon Code</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Add Coupon Code
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.message')
            <div class="content-body">
                <!-- Bootstrap Select start -->
                <!-- Basic Select2 start -->
                <section class="basic-select2">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add New Coupon Code</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form enctype="multipart/form-data" method="POST"
                                            action="{{ route('coupon-code.store') }}">
                                            @csrf
                                            <div class="row">

                                                <div class="col-sm-6 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Name
                                                        </div>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="name" id="name"
                                                                placeholder="Enter name" required>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-4 col-12 mb-1">
                                                    <fieldset>
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Select Coupon Type
                                                        </div>
                                                        <div class="input-group">
                                                            <select class="form-control" id="select1-student"
                                                                name="type" required>

                                                                <option selected disabled >Select Student</option>
                                                                <option value="flat" >Flat</option>
                                                                <option value="percent" >Percent</option>

                                                            </select>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-4 col-12 mb-1">
                                                    <fieldset>
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Coupon Amount
                                                        </div>
                                                        <div class="input-group">
                                                         <input type="text" class="form-control" name="amount" id="name"
                                                         placeholder="Enter name" required>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-4 col-12 mb-1">
                                                    <fieldset>
                                                        <div class="text-bold-600 font-medium-2 mb-2">
                                                            Select students
                                                        </div>
                                                        <div class="input-group">
                                                            <select class="select2 form-select" id="select2-student"
                                                                name="select_student[]" multiple required>

                                                                @foreach ($users as $user)
                                                                    <option value="{{$user->id}}">{{$user->name}} {{$user->phone}} {{$user->email}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </fieldset>
                                                </div>

                                            </div>
                                            <br>
                                            <button class="btn btn-primary waves-effect waves-light"
                                                type="submit">Submit</button>
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
