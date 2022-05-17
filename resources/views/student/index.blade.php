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
                                                                <select class="select2 form-select" id="select2-location" name="location">
                                                                    <option value="all" {{ $selectedlocation=='all'?'selected':''}}>All</option>
                                                                    @foreach ($locationlist as $location)
                                                                        <option value="{{$location->id}}" {{$location->id==$selectedlocation?'selected':'' }}>{{$location->location_name}}</option>
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
                                                                <select class="select2 form-select" id="select2-batch" name="batch">
                                                                <option value="all" {{ $selectedbatch=='all'?'selected':''}}>Select Batch</option>
                                                                @foreach ($batcheslist as $batch)
                                                                        <option value="{{$batch->id}}" {{$batch->id==$selectedbatch?'selected':'' }}>{{$batch->batch_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                </div>
                                                            </fieldset>
                                                        </div>

                                                       
                                                        
                                                       
                                                        <div class="col-md-2 col-12 mb-1">
                                                            <fieldset>
                                                            <div class="text-bold-600 font-medium-2 mb-2">
                                                            &nbsp; 
                                                            </div>
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
                                                            <div class="text-bold-600 font-medium-2 mb-2">
                                                            Count
                                                            </div>
                                                            <div class="input-group">
                                                                {{$studentscount}}
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
                                    <!-- <p class="card-text">Using the most basic table Leanne Grahamup, here’s how <code>.table</code>-based tables look in Bootstrap. You can use any example of below table for your table and it can be use with any type of bootstrap tables.</p>
                               <p><span class="text-bold-600">Example 1:</span> Table with outer spacing</p> -->
                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Student name</th>
                                                    <th>Location name</th>
                                                    <th>Batch name</th>

                                                    <th>Mobile number</th>
                                                    <th>Date of Joining</th>

                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($studentslist as $student)
                                                    <tr>
                                                        <th scope="row">
                                                            {{ $student->name }}
                                                        </th>
                                                        <th scope="row">
                                                            {{ $student->batch ? $student->batch->location->location_name : '' }}
                                                        </th>
                                                        <th scope="row">
                                                            {{ $student->batch ? $student->batch->batch_name : '' }}
                                                        </th>

                                                        <th scope="row">
                                                            {{ $student->phone }}
                                                        </th>
                                                        <th scope="row">
                                                            {{ $student->created_at }}
                                                        </th>


                                                        <td>
                                                        <a href="{{ route('students.show', $student->id) }}"
                                                                target="_blank" class="btn btn-circle btn-success"><i
                                                                    class="fa fa-eye"></i></a>

                                                        <a href="{{ route('students.addbatch', $student->id) }}"
                                                                class="btn btn-circle btn-primary"><i
                                                                    class="fa fa-plus"></i></a>

                                                            <a href="{{ route('students.edit', $student->id) }}"
                                                                target="_blank" class="btn btn-circle btn-warning"><i
                                                                    class="fa fa-pencil"></i></a>
                                                            <a onclick="return confirm('Are you sure to delete?')"
                                                                href="{{ route('students.delete', $student->id) }}"
                                                                class="btn btn-circle btn-danger"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $studentslist->links() }}


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
$(document).ready(function () {
// on location select
    $('#select2-location').on('change', function() {
        
        $.ajax({
            type: "get",
            url: '/location/getbatches/'+this.value ,
            success: function (data) {
                let details=JSON.parse(data);
                console.log(data);
                var $mySelect = $('#select2-batch');
                $('#select2-batch').find('option').remove().end();
                var $option='';
                $option+="<option value='all'>Select option</option>";
                $.each(details.responce, function(key, value) {
                $option+= "<option value="+value.id+">"+value.batch_name+"</option>";
                });
                $mySelect.append($option);


        }
    })
});

$('#select2-batch').on('change', function() {
        
        $.ajax({
            type: "get",
            url: '/batch/stuents/'+this.value ,
            success: function (data) {
                let details=JSON.parse(data);
                console.log(data);
                var $mySelect = $('#select2-student');
                $('#select2-student').find('option').remove().end();
                var $option='';
                $option+="<option value='all'>Select option</option>";
                $.each(details.responce, function(key, value) {
                $option+= "<option value="+value.id+">"+value.name+"</option>";
                });
                $mySelect.append($option);


        }
    })
});



});

</script>
@endpush
