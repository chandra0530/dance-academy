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
                            <h2 class="content-header-title float-left mb-0">Students List</h2>
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.message')
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
                                                                <div class="text-bold-600 font-medium-2 mb-2">
                                                                    Select Location
                                                                </div>
                                                                <div class="input-group">
                                                                    <select class="select2 form-select"
                                                                        id="select2-location" name="location">
                                                                        <option value="all"
                                                                            {{ $selectedlocation == 'all' ? 'selected' : '' }}>
                                                                            All</option>
                                                                        @foreach ($locationlist as $location)
                                                                            <option value="{{ $location->id }}" {{$selectedlocation==$location->id??'selected'}}>
                                                                                {{ $location->location_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-4 col-12 mb-1">
                                                            <fieldset>
                                                                <div class="text-bold-600 font-medium-2 mb-2">
                                                                    Select Batch
                                                                </div>
                                                                <div class="input-group">
                                                                    <select class="select2 form-select" id="select2-batch"
                                                                        name="batch">
                                                                        <option value="all"
                                                                            {{ $selectedlocation == 'all' ? 'selected' : '' }}>
                                                                            Select Batch</option>


                                                                    </select>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-4 col-12 mb-1">
                                                            <fieldset>
                                                                <div class="text-bold-600 font-medium-2 mb-2">
                                                                    Select Student
                                                                </div>
                                                                <div class="input-group">
                                                                    <select class="select2 form-select" id="select2-student"
                                                                        name="select_student">

                                                                        <option value="all"
                                                                            {{ $selectedlocation == 'all' ? 'selected' : '' }}>
                                                                            Select Student</option>

                                                                    </select>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <div class="col-md-2 col-12 mb-1">
                                                            <fieldset>
                                                                <div class="input-group">
                                                                    <button class="btn btn-primary waves-effect waves-light"
                                                                        type="submit"><i class="feather icon-search"></i>
                                                                    </button>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <!-- <div class="col-md-2 col-12 mb-1">
                                                                <fieldset>
                                                                    <div class="input-group">
                                                                        <a href="#"
                                                                           class="btn btn-round btn-success waves-effect waves-light"
                                                                           type="button"><i
                                                                                class="feather icon-database"></i> Export
                                                                            CSV</a>
                                                                    </div>
                                                                </fieldset>
                                                            </div> -->

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
                                <h4 class="card-title">All Students</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- <p class="card-text">Using the most basic table Leanne Grahamup, here???s how <code>.table</code>-based tables look in Bootstrap. You can use any example of below table for your table and it can be use with any type of bootstrap tables.</p>
                               <p><span class="text-bold-600">Example 1:</span> Table with outer spacing</p> -->
                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table-striped mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th>Student name</th>
                                                    <th>Student Email</th>
                                                    <th>Batch Name</th>
                                                    <th>Month Name</th>
                                                    <th>Fees</th>
                                                    <th>Status</th>


                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($fees as $fee)
                                                    <tr>
                                                        <th scope="row">
                                                            {{ $fee->user->name }}
                                                        </th>
                                                        <th scope="row">
                                                            {{ $fee->user->email }}
                                                        </th>

                                                        <th scope="row">
                                                            {{ $fee->batch->batch_name }}
                                                        </th>
                                                        <th scope="row">
                                                            {{$fee->month}}
                                                            {{ date('F', mktime(0, 0, 0, $fee->month, 10)) }}
                                                        </th>
                                                        <th scope="row">
                                                            {{ $fee->fees }}
                                                        </th>
                                                        <th scope="row">
                                                            {{ $fee->status }}
                                                        </th>


                                                        <td>
                                                            @if ($fee->status == 'unpaid')
                                                                <a onclick="return confirm('Are you sure want to mark it as paid?')"
                                                                    href="{{ url('fees/markpaid', $fee->id) }}"
                                                                    class="btn btn-circle btn-danger">Paid</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $fees->withQueryString()->links() }}
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
@push('js')
    <script>
        $(document).ready(function() {
            // on location select
            $('#select2-location').on('change', function() {

                $.ajax({
                    type: "get",
                    url: '/location/getbatches/' + this.value,
                    success: function(data) {
                        let details = JSON.parse(data);
                        console.log(data);
                        var $mySelect = $('#select2-batch');
                        $('#select2-batch').find('option').remove().end();
                        var $option = '';
                        $option += "<option value='all'>Select option</option>";
                        $.each(details.responce, function(key, value) {
                            $option += "<option value=" + value.id + ">" + value
                                .batch_name + "</option>";
                        });
                        $mySelect.append($option);


                    }
                })
            });

            $('#select2-batch').on('change', function() {

                $.ajax({
                    type: "get",
                    url: '/batch/stuents/' + this.value,
                    success: function(data) {
                        let details = JSON.parse(data);
                        console.log(data);
                        var $mySelect = $('#select2-student');
                        $('#select2-student').find('option').remove().end();
                        var $option = '';
                        $option += "<option value='all'>Select option</option>";
                        $.each(details.responce, function(key, value) {
                            $option += "<option value=" + value.id + ">" + value.name +
                                "</option>";
                        });
                        $mySelect.append($option);


                    }
                })
            });



        });
    </script>
@endpush
