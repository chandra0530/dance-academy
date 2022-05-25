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
                  <h2 class="content-header-title float-left mb-0">Attendance</h2>
                  <div class="breadcrumb-wrapper col-12">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Add Attendance
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
                        <h4 class="card-title">Add New Attendance</h4>
                     </div>
                     <div class="card-content">
                        <div class="card-body">
                           <form enctype="multipart/form-data" method="POST"
                              action="{{ route('attendance.store') }}">
                              @csrf
                              <div class="row">


                              <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Select location
                                    </div>
                                    <div class="input-group">
                                    <select class="select2 form-select" id="select2-product" name="location">
                                        <option >Select location</option>
                                        @foreach ($locationlist as $location)
                                            <option value="{{$location->id}}">{{$location->location_name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </fieldset>
                                 </div>
                                 
                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                       Select Batch
                                    </div>
                                    <div class="input-group">
                                    <select class="select2 form-select" id="select2-batch" name="batch">
                                        
                                    </select>
                                    </div>
                                 </fieldset>
                                 </div>

                                 <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    <div class="text-bold-600 font-medium-2 mb-2">
                                        Date
                                    </div>
                                    <div class="input-group">
                                    <input type="date" class="form-control" name="date" id="date" placeholder="Start Time">
                                    </div>
                                 </fieldset>
                                 </div>
                                 <div class="col-sm-6 col-12">
                                 
                                 </div>
<div id="student_list" class="row" style="width:100%">
</div>
                                 <!-- <div class="col-sm-6 col-12">
                                 <fieldset class="form-group">
                                    
                                       Students
                                    
                                    <div class="input-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" >
                                        <label class="form-check-label" for="inlineRadio1">Present</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female" checked>
                                        <label class="form-check-label" for="inlineRadio2">Absent</label>
                                    </div>
                                    </div>
                                 </fieldset>
                                 </div> -->
                                 <!-- <div class="col-sm-6 col-12">
                                 
                                 </div> -->
                                
                              <br>
                              
                        </div>
                        <button class="btn btn-primary waves-effect waves-light" type="submit">Submit</button>
                           </form>
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
<script>
$(document).ready(function () {
// on location select
    $('#select2-product').on('change', function() {
        
        $.ajax({
            type: "get",
            url: '/location/getbatches/'+this.value ,
            success: function (data) {
                let details=JSON.parse(data);
                console.log(data);
                var $mySelect = $('#select2-batch');
                $('#select2-batch').find('option').remove().end();
                var $option='';
                $option+="<option>Select option</option>";
                $.each(details.responce, function(key, value) {
                $option+= "<option value="+value.id+">"+value.batch_name+"</option>";
                });
                $mySelect.append($option);


        }
    })
});
// on batch select
$('#select2-batch').on('change', function() {
  
  $.ajax({
            type: "get",
            url: '/batch/stuents/'+this.value ,
            success: function (data) {
                let details=JSON.parse(data);
                console.log(data);
                var $mySelect = $('#student_list');
                $('#student_list').html()
                var $option='';
                $.each(details.responce, function(key, value) {
                $option+= '<div class="col-sm-6 col-12"><fieldset class="form-group"><div class="text-bold-600 font-medium-2 mb-2">'+value.name+'</div><div class="input-group">';
                $option+='<div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="attendance['+value.id+']" id="inlineRadio1" value="present" checked><label class="form-check-label" for="inlineRadio1">Present</label>';
                $option+='</div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="attendance['+value.id+']" id="inlineRadio2" value="absent" >';
                $option+='<label class="form-check-label" for="inlineRadio2">Absent</label></div></div></fieldset></div>';
                });
                $mySelect.html($option);


        }
    })
});


});

</script>
@endpush