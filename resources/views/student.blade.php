
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaps On Beats</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons&style=outlined" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">
    <link href="{{ asset('app-assets/student-registration/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('app-assets/student-registration/css/style.css') }}" rel="stylesheet">
    
    <link href="{{ asset('app-assets/student-registration/css/all.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="py-5">
            <form enctype="multipart/form-data" method="POST" class="student-registration-form col-lg-9 mx-auto"
                              action="{{ url('student/register') }}">
                              @csrf
                <div class="form-head py-3">
                    <h2>Application From</h2>
                </div>
                <div class="form-section-title">
                    <h2>Applicant Information</h2>
                </div>
                <div class="py-lg-4 py-md-4 px-lg-4 px-md-0 py-4">
                    <div class="form-row">
                        <div class="col-md-8 order-md-0 order-1">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" />
                            </div>
                            <div class="form-group">
                                <label for="pname">Parent's Name (If Student is minor)</label>
                                <input type="text" class="form-control" id="pname"  name="pname"/>
                            </div>
                        </div>
                        <div class="form-group col-md-3 offset-md-1 col-5 mx-auto mb-3">
                            <div class="position-relative passportPhoto-container">
                                <label for="photo">Upload photo</label>
                                <input type="file" name="photo" class="form-control" hidden id="photo" onchange="selectPhoto(this)">
                                <img id="displayPhoto" src="#" alt="your image" style="display: none;" />
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-8">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" class="form-control" name="dob" id="dob">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Contact Number</label>
                                    <input type="tel" class="form-control" name="phone" id="phone">
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="caddress">Current Address</label>
                                <textarea rows="5" class="form-control" id="caddress"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="paddress">Permanent Address</label>
                                <textarea rows="5" class="form-control" id="paddress"></textarea>
                            </div> -->
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="state">State</label>
                                    <select id="state" class="form-control" name="state">
                                        <option>Choose...</option>
                                        @foreach ($stateslist as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" id="city">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="zip">ZIP Code</label>
                                    <input type="tel" class="form-control" name="zip" id="zip">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="hobby">Hobby/Interest</label>
                                <textarea rows="8"  name="hobby" class="form-control" id="hobby"></textarea>
                            </div>
                            <!-- <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" class="form-control" id="occupation">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                            </div>
                             -->
                            <!-- <div class="form-group">
                                <label for="doj">Date of Joining</label>
                                <input type="date" class="form-control" id="doj">
                            </div> -->
                            <div class="form-row align-items-center">
                                <div class="form-group col-auto my-1">
                                    <label class="" for="">Any Previous medical injury/illness/hospitalization?</label>
                                    
                                </div>
                                <div class="form-group col-auto my-1">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" value="1"
                                            id="is_medical_injury" name="is_medical_injury">
                                        <label class="custom-control-label" for="is_medical_injury"></label>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="medical_details" id="medical_details">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <select id="location" class="form-control" name="location">
                                    <option selected>Choose...</option>
                                    @foreach ($locationlist as $location)
                                        <option value="{{$location->id}}">{{$location->location_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group batch">
                                <label for="batch">Batch</label>
                                <div class="p-0" id="batches_list">
                                    <span>
                                        <input type="radio" id="6-7" name="batch" value="">
                                        <label for="6-7">6pm-7pm</label>
                                    </span>
                                    <span>
                                        <input type="radio" id="7-8" name="batch" value="">
                                        <label for="7-8">7pm-8pm</label>
                                    </span>
                                    <span>
                                        <input type="radio" id="8-9" name="batch" value="">
                                        <label for="8-9">8pm-9pm</label>
                                    </span>
                                    <span>
                                        <input type="radio" id="9-10" name="batch" value="">
                                        <label for="9-10">9pm-10pm</label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

                <div class="form-section-title">
                    <h2>Career Information</h2>
                </div>
                
                <div class="py-lg-4 py-md-4 px-lg-4 px-md-0 py-4">

                <div class="form-row" id="minor-registration" style="display:none">
                        <div class="form-group col-md-6">
                            <label for="school">School</label>
                            <input type="text" class="form-control" placeholder="Enter School" id="school" name="school" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="std">Standard</label>
                            <input type="text" class="form-control" id="std" placeholder="Enter Standard"  name="std"/>
                        </div>
                    </div>
            
                    <div class="form-row" id="sinior-registration" style="display:none">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="qualification">Educational Qualification</label>
                                <input type="text" class="form-control" id="qualification" placeholder="Educational Qualification" name="qualification" />
                            </div>
                            <!-- <div class="form-group">
                                <label for="institution">Institution/College</label>
                                <input type="text" class="form-control" id="institution" placeholder="Institution/College" name="institution" />
                            </div> -->
                        </div>
                        <div class="form-group col-md-6">
                                <label for="institution">Institution/College</label>
                                <input type="text" class="form-control" id="institution" placeholder="Institution/College" name="institution" />
                        </div>
                    </div>


                    

                    <div id="sinior2-registration" style="display:none">
                  
                    <div class="form-row align-items-center">
                        <div class="form-group col-auto my-1">
                            <label class="" for="">Dance training/Workshop/Camps/Classes attended and /or conducted by you:</label>
                        </div>
                        <div class="form-group col-auto my-1">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" value="1" name="is_dance_training" id="is_dance_training">
                                <label class="custom-control-label" for="contract"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder=""
                            id="careerchoice" name="dance_training_details">
                    </div>

                    <div class="form-group col-md-6">
                            <label for="ambition">How did you get to know about this institution?</label>
                            <input type="text" class="form-control" placeholder=""
                            id="careerchoice" name="institute_referance">
                            <!-- <textarea rows="5" class="form-control" id="ambition" name="ambition" ></textarea> -->
                        </div>
                    </div>
                    
                   
                    <!-- <div class="form-group row">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary">Proceed</button>
                        </div>
                    </div> -->
                </div>


                <div class="form-row align-items-center">
                        <div class="form-group col-auto my-1">
                            <label class="" for="">Have you participated in dance reality show ?</label>
                        </div>
                        <div class="form-group col-auto my-1">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="is_reality_show" value="1" name="is_reality_show">
                                <label class="custom-control-label" for="is_reality_show"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="" id="reality_show_details" name="reality_show_details">
                    </div>


                <div class="form-row align-items-center">
                        <div class="form-group col-auto my-1">
                            <label class="" for="">Would you be intreasted in participating in any event/reality show/competitin  :</label>
                        </div>
                        <div class="form-group col-auto my-1">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" value="1" id="is_intreasted_for_reality_show" name="is_intreasted_for_reality_show">
                                <label class="custom-control-label" for="is_intreasted_for_reality_show"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="" id="careerchoice" name="intreasted_for_reality_show">
                    </div>

           
                <div class="form-section-title">
                    <h2>Disclaimer Liability Waiver</h2>
                </div>
                <div class="py-lg-4 py-md-4 px-lg-4 px-md-0 py-4">
                    <p>
                    I hereby declare that all the particulars stated in this form are true to the best of my knowledge. In the event of submission of fraudulent, incorrect as untrue information, suppression or distortion of any fact, I understand that, my admission into the institution is on the sole discretion of Leaps On Beats and there said decision will be final binding. 
</p><p>
The student understands, acknowledges & accepts that participation in dance classes and shows, is a strength physical activity and may involve risk of accident or injury to the student’s possession and property. In any case, of an accident or injury of any nature to any student, Leaps On Beats shall not be responsible. 
</p>

                    </p>
                    <p>
                    Leaps On Beats at its sole discretion, reserves the right to reject the participation of the student in any case. 
                    </p>
                </div>

                <div class="form-section-title">
                    <h2>Rules & Regulation</h2>
                </div>
                <div class="py-lg-4 py-md-4 px-lg-4 px-md-0 py-4">
                    <div class="rules">
                        <ul>
                            <li>
                            The monthly fee is to be paid on or before 10th of every month. Payment after 10th will lead to fine (Rs.300/-).

                            </li>
                            <li>
                            If student attends 50% or above of the total number of classes in a month, needs to pay the full amount.

                            </li>
                            <li>
                            If student attends no or less than 50% of the total number of classes in a month, needs to pay 50% of the total amount.

                            </li>
                            <li>
                            Students will be responsible for their valuables and belongings the management shall not be responsible for any loss or damage. 

                            </li>
                            <li>
                            Students are required to wear proper attire for the classes (Track Pant & T-Shirt).
                            </li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agree"
                                style="height: auto !important; margin-top: 7px;" name="medical_details">
                            <label class="form-check-label" for="agree">
                                I agress to above rules & regulations
                            </label>
                        </div>
                    </div>
                    <div class="form-group row mt-sm-5">
                        <div class="col-sm-8 mx-auto">
                            <button type="submit" class="btn btn-primary w-100 stickyRegister">Register</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>


    </div>


    <script src="{{ asset('app-assets/student-registration/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('app-assets/student-registration/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function selectPhoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#displayPhoto').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function () {
            $('#batches_list').html('');
// on location select
    $('#location').on('change', function() {
        
        $.ajax({
            type: "get",
            url: '/location/getbatches/'+this.value ,
            success: function (data) {
                let details=JSON.parse(data);
                console.log(data);
                
                $('#batches_list').html('');
                var $option='';
                $.each(details.responce, function(key, value) {
                $option+= '<span><input type="radio" id="id_'+key+'" name="batch_id" value="'+value.id+'"><label for="id_'+key+'">'+value.batch_name+'</label></span>';
                });
                $('#batches_list').html($option);


        }
    })
});

$("#dob").change(function() {
                // $(this).css("background-color", "#7FFF00");
                console.log($(this).val());
                var now = new Date();
                var past = new Date($(this).val());
    var nowYear = now.getFullYear();
    var pastYear = past.getFullYear();
    var age = nowYear - pastYear;
if(age>18){
$("#minor-registration").hide();
$("#sinior-registration").show();
$("#sinior2-registration").show();
}else{
    $("#minor-registration").show();
$("#sinior-registration").hide();
$("#sinior2-registration").hide();
}
    // return age;
            });

});
    </script>



</body>

</html>