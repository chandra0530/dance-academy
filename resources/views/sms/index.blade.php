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
                  <h2 class="content-header-title float-left mb-0">Send Custom sms</h2>
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
                                            <form enctype="multipart/form-data" method="POST"
                              action="{{ route('publish-message') }}">
                              @csrf
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
                                                                        <option value="{{$location->id}}">{{$location->location_name}}</option>
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
                                                                <select class="select2 form-select" id="select2-student" name="select_student[]" multiple>
                                                                      
                                                                
                                                                </select>
                                                                </div>
                                                            </fieldset>
                                                        </div>

                                                        <div class="col-md-4 col-12 mb-1">
                                                            <fieldset>
                                                            <div class="text-bold-600 font-medium-2 mb-2">
                                                            Select Sms Template
                                                            </div>
                                                            <div class="input-group">
                                                                <select class="select2 form-select" id="select2-smstemplate" name="sms_template">
                                                                <option value="all">Select Template</option>
    
                                                                @foreach ($smstemplates as $template)
                                                                        <option value="{{$template->id}}">{{$template->template_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                </div>
                                                            </fieldset>
                                                        </div>


                                                        <div class="col-md-4 col-12 mb-1">
                                                            <fieldset>
                                                            <div class="text-bold-600 font-medium-2 mb-2">
                                                            Sms Template Preview
                                                            </div>
                                                            
                                                            <h6 id="smspreview"></h6>
                                                            </fieldset>
                                                        </div>


                                                        <div class="col-md-4 col-12 mb-1">
                                                            <fieldset>
                                                            <div class="text-bold-600 font-medium-2 mb-2">
                                                            Sms Variables
                                                            </div>
                                                            
                                                            <div id="sms-variables"></div>
                                                            </fieldset>
                                                        </div>
                                                       



                                                        <br>
                                                        <br>
                                                        <div class="col-md-2 col-12 mb-1">
                                                            <fieldset>
                                                                <div class="input-group">
                                                                    <button
                                                                        class="btn btn-primary waves-effect waves-light"
                                                                        type="submit">Send sms
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

$('#select2-smstemplate').on('change', function() {
        
        $.ajax({
            type: "get",
            url: 'sms-template-details/'+this.value ,
            success: function (data) {
                let details=JSON.parse(data);
                console.log(details);
                let variables=details.responce.variables.split(',');
                console.log(variables);
                $('#smspreview').html(details.responce.sms_template_example);
                let input='';
                $.each(variables, function (key, val) {
                    input+=val+":<input type='text' class='form-control' name='input["+val+"]'><br>";
                });
                $('#sms-variables').html(input);

        }
    })
});



});

</script>
@endpush
