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
                  <h2 class="content-header-title float-left mb-0">Batch</h2>
                  <div class="breadcrumb-wrapper col-12">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Edit Batch
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
                        <h4 class="card-title">Edit Batch</h4>
                     </div>
                     <div class="card-content">
                        <div class="card-body">
                           <form enctype="multipart/form-data" method="POST"
                              action="{{ route('batch.update',$batch_details->id) }}">
                              @csrf
                              <div class="row">
                              <input type="hidden" name="_method" value="PUT">

                              <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Select location
                                    </div>
                                    <div class="input-group">
                                    <select class="select2 form-select" id="select2-product" name="location" required>
                                        <option >Select location</option>
                                        @foreach ($locationlist as $location)
                                            <option value="{{$location->id}}" {{$batch_details->location_id==$location->id?'selected':''}}>{{$location->location_name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </fieldset>
                                 </div>
                                 
                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Name
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{$batch_details->batch_name}}" required>
                                    </div>
                                 </fieldset>
                                 </div>

                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Start Time
                                    </div>
                                    <div class="input-group">
                                    <input type="time" class="form-control" name="start_time" id="start_time" placeholder="Start Time" value="{{$batch_details->batch_start_time}}" required>
                                    </div>
                                 </fieldset>
                                 </div>
                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       End Time
                                    </div>
                                    <div class="input-group">
                                    <input type="time" class="form-control" name="end_time" id="end_time" placeholder="End Time" value="{{$batch_details->batch_end_time}}" required>
                                    </div>
                                 </fieldset>
                                 </div>

                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Fees
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="fees" id="fees" placeholder="Enter fees" value="{{$batch_details->fees}}" required>
                                    </div>
                                 </fieldset>
                                 </div>
                                    @php
                                    $selecteddays=explode(',',$batch_details->days);
                                    @endphp

                                 <div class="col-sm-12 col-12">
                                 <div class="demo-inline-spacing" style="display: flex;">
            <div class="form-check form-check-primary">
              <input type="checkbox" class="form-check-input" id="colorCheck1" name="day[]" value="1" {{in_array(1, $selecteddays)?'checked':''}}>
              <label class="form-check-label" for="colorCheck1">Monday</label>
            </div>
            <div class="form-check form-check-secondary">
              <input type="checkbox" class="form-check-input" id="colorCheck2" name="day[]" value="2" {{in_array(2, $selecteddays)?'checked':''}}>
              <label class="form-check-label" for="colorCheck2">Tuesday</label>
            </div>
            <div class="form-check form-check-success">
              <input type="checkbox" class="form-check-input" id="colorCheck3" name="day[]" value="3" {{in_array(3, $selecteddays)?'checked':''}}>
              <label class="form-check-label" for="colorCheck3">Wednessday</label>
            </div>
            <div class="form-check form-check-danger">
              <input type="checkbox" class="form-check-input" id="colorCheck5" name="day[]" value="4" {{in_array(4, $selecteddays)?'checked':''}}>
              <label class="form-check-label" for="colorCheck5">Thursday</label>
            </div>
            <div class="form-check form-check-warning">
              <input type="checkbox" class="form-check-input" id="colorCheck4" name="day[]" value="5" {{in_array(5, $selecteddays)?'checked':''}}>
              <label class="form-check-label" for="colorCheck4">Friday</label>
            </div>
            <div class="form-check form-check-info">
              <input type="checkbox" class="form-check-input" id="colorCheck6" name="day[]" value="6" {{in_array(6, $selecteddays)?'checked':''}}>
              <label class="form-check-label" for="colorCheck6">Saturday</label>
            </div>
            <div class="form-check form-check-info">
              <input type="checkbox" class="form-check-input" id="colorCheck7" name="day[]" value="7" {{in_array(7, $selecteddays)?'checked':''}}>
              <label class="form-check-label" for="colorCheck7">Sunday</label>
            </div>
          </div>
                        </div>         
                            
                              </div>
                              <br>
                              <button class="btn btn-primary waves-effect waves-light" type="submit">Update</button>
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