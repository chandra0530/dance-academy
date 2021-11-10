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
                  <h2 class="content-header-title float-left mb-0">Students</h2>
                  <div class="breadcrumb-wrapper col-12">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Add Students
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
                        <h4 class="card-title">Add New Students</h4>
                     </div>
                     <div class="card-content">
                        <div class="card-body">
                           <form enctype="multipart/form-data" method="POST"
                              action="{{ route('students.store') }}">
                              @csrf
                              <div class="row">
                                 
                              <!---->
                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Name
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                                    </div>
                                 </fieldset>
                                 </div>
                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Parent name
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                                    </div>
                                 </fieldset>
                                 </div>

                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Date of birth
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                                    </div>
                                 </fieldset>
                                 </div>
                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Phone
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone">
                                    </div>
                                 </fieldset>
                                 </div> 

                                 <div class="col-sm-4 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       State
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone">
                                    </div>
                                 </fieldset>
                                 </div> 
                                 <div class="col-sm-4 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       City
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone">
                                    </div>
                                 </fieldset>
                                 </div> 
                                 <div class="col-sm-4 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Zipcode
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone">
                                    </div>
                                 </fieldset>
                                 </div> 

                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Hobby/Intreast
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                 </fieldset>
                                 </div> 

                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Any previous medical injury/illness/hospitalization ?
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                 </fieldset>
                                 </div> 

                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       School
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                 </fieldset>
                                 </div> 
                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Standard
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                 </fieldset>
                                 </div> 


                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Educational Qualification
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                 </fieldset>
                                 </div> 
                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Institute/College
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                 </fieldset>
                                 </div> 
                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Dance training/workshop/Camps/classess attended or conducted by you
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                 </fieldset>
                                 </div> 
                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       How do you get to know about this institution
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                 </fieldset>
                                 </div> 

                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Have you participated in dance reality show ?

                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                 </fieldset>
                                 </div> 
                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Would you be inntreasted in participating in any event/reality show/ compitition ?
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                 </fieldset>
                                 </div> 





                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Email
                                    </div>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                 </fieldset>
                                 </div> 

                                
                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Gender
                                    </div>
                                    <div class="input-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" >
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female" checked>
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div>
                                    </div>
                                 </fieldset>
                                 </div> 

                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Select location
                                    </div>
                                    <div class="input-group">
                                    <select class="select2 form-select" id="select2-product" name="batch_id">
                                        <option >Select location</option>
                                        @foreach ($batchlist as $batch)
                                            <option value="{{$batch->id}}">{{$batch->location->location_name}}{{$batch->batch_name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </fieldset>
                                 </div> 
                            
                              </div>
                              <br>
                              <button class="btn btn-primary waves-effect waves-light" type="submit">Submit</button>
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