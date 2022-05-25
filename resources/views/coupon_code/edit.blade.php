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
                  <h2 class="content-header-title float-left mb-0">Location</h2>
                  <div class="breadcrumb-wrapper col-12">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Update Location
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
                        <h4 class="card-title">Update Location</h4>
                     </div>
                     <div class="card-content">
                        <div class="card-body">
                           <form enctype="multipart/form-data" method="POST"
                              action="{{ route('location.update',$location_details->id) }}">
                              @csrf
                              <input type="hidden" name="_method" value="PUT">
                              <div class="row">
                                 
                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Name
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{$location_details->location_name}}">
                                    </div>
                                 </fieldset>
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