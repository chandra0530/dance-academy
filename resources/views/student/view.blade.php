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
                                    <li class="breadcrumb-item active">Details
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.message')
            <div class="content-body">
                <section class="app-user-view-account">
                    <div class="row">
                        <!-- User Sidebar -->
                        <div class="col-xl-4 col-lg-5 col-md-5 order-md-0 order-1">
                            <!-- User Card -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class="d-flex align-items-center flex-column">
                                            <img class="img-fluid mt-3 mb-2 rounded"
                                                src="{{ $userdetails->image ?? 'https://img.freepik.com/free-vector/hand-drawn-international-dance-day-illustration_23-2148878967.jpg?t=st=1651831014~exp=1651831614~hmac=e85cf239a4e4ed7b19cf8b59ab9bd97f05a30a8b41a109d48ac1bb6a476cb5dd&w=740' }}"
                                                height="110" width="110" alt="User avatar" />
                                            <!-- <div class="user-info text-center">
                                           <h4>Gertrude Barton</h4>
                                           <span class="badge bg-light-secondary">Author</span>
                                        </div> -->
                                        </div>
                                    </div>

                                    <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Name:</span>
                                                <span>{{ $userdetails->name }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Email:</span>
                                                <span>{{ $userdetails->email }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Phone:</span>
                                                <span class="badge bg-light-success">{{ $userdetails->phone }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Parent Name:</span>
                                                <span>{{ $userdetails->parent_name }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">DOB:</span>
                                                <span>{{ $userdetails->dob }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">City:</span>
                                                <span>{{ $userdetails->city }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">State :</span>
                                                <span>{{ $userdetails->state_id }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">ZipCode:</span>
                                                <span>{{ $userdetails->zip_code }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Hobbies:</span>
                                                <span>{{ $userdetails->hobbies }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">School:</span>
                                                <span>{{ $userdetails->school_details }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Date of Registration:</span>
                                                <span>{{ $userdetails->created_at->format('d/m/Y') }}</span>
                                            </li>
                                        </ul>
                                        <!-- <div class="d-flex justify-content-center pt-2">
                                        <a href="javascript:;" class="btn btn-primary me-1" data-bs-target="#editUser" data-bs-toggle="modal">
                                        Edit
                                        </a>
                                        <a href="javascript:;" class="btn btn-outline-danger suspend-user">Suspended</a>
                                     </div> -->
                                    </div>
                                </div>
                            </div>
                            <!-- /User Card -->
                            <!-- Plan Card -->
                            <div class="card border-primary" >
                                <div class="card-body">

                                 <h4 class="card-header">User Batch Details</h4>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Location Name</th>
                                            <th>Batch</th>
                                            <th class="cell-fit">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($userbatchdetails as $item)
                                       <tr>
                                          <td>{{$item->batch->location->location_name}}</td>
                                          <td>{{$item->batch->batch_name}}</td>
                                          <td>

                                             <a onclick="return confirm('Are you sure to delete?')"
                                                                href="{{ route('student.batch.delete', $item->id) }}"
                                                                class="btn btn-circle btn-danger"><i
                                                                    class="fa fa-trash"></i></a>

                                          </td>
                                       </tr>
                                           
                                       @endforeach
                                       
                                    </tbody>
                                </table>
                                    
                                  
                                    
                                </div>
                            </div>
                            <!-- /Plan Card -->
                        </div>
                        <!--/ User Sidebar -->
                        <!-- User Content -->
                        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">

                            <!-- Project table -->
                            <div class="card" style="display:none">
                                <h4 class="card-header">User's Projects List</h4>
                                <div class="table-responsive">
                                    <table class="datatable-project table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Project</th>
                                                <th class="text-nowrap">Total Task</th>
                                                <th>Progress</th>
                                                <th>Hours</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- /Project table -->

                            <!-- Invoice table -->
                            <div class="card">
                                <h4 class="card-header">User Fee Payment Details</h4>

                                <table class="invoice-table text-nowrap table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>#ID</th>
                                            <th><i data-feather="trending-up"></i></th>
                                            <th>TOTAL Paid</th>
                                            <th class="text-truncate">Issued Date</th>
                                            <th class="cell-fit">Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /Invoice table -->
                        </div>
                        <!--/ User Content -->
                    </div>
                </section>
                <!-- Edit User Modal -->
                <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 pt-50 pb-5">
                                <div class="mb-2 text-center">
                                    <h1 class="mb-1">Edit User Information</h1>
                                    <p>Updating user details will receive a privacy audit.</p>
                                </div>
                                <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserFirstName">First Name</label>
                                        <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName"
                                            class="form-control" placeholder="John" value="Gertrude"
                                            data-msg="Please enter your first name" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserLastName">Last Name</label>
                                        <input type="text" id="modalEditUserLastName" name="modalEditUserLastName"
                                            class="form-control" placeholder="Doe" value="Barton"
                                            data-msg="Please enter your last name" />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="modalEditUserName">Username</label>
                                        <input type="text" id="modalEditUserName" name="modalEditUserName"
                                            class="form-control" value="gertrude.dev" placeholder="john.doe.007" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserEmail">Billing Email:</label>
                                        <input type="text" id="modalEditUserEmail" name="modalEditUserEmail"
                                            class="form-control" value="gertrude@gmail.com"
                                            placeholder="example@domain.com" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserStatus">Status</label>
                                        <select id="modalEditUserStatus" name="modalEditUserStatus" class="form-select"
                                            aria-label="Default select example">
                                            <option selected>Status</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                            <option value="3">Suspended</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditTaxID">Tax ID</label>
                                        <input type="text" id="modalEditTaxID" name="modalEditTaxID"
                                            class="form-control modal-edit-tax-id" placeholder="Tax-8894"
                                            value="Tax-8894" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserPhone">Contact</label>
                                        <input type="text" id="modalEditUserPhone" name="modalEditUserPhone"
                                            class="form-control phone-number-mask" placeholder="+1 (609) 933-44-22"
                                            value="+1 (609) 933-44-22" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserLanguage">Language</label>
                                        <select id="modalEditUserLanguage" name="modalEditUserLanguage"
                                            class="select2 form-select" multiple>
                                            <option value="english">English</option>
                                            <option value="spanish">Spanish</option>
                                            <option value="french">French</option>
                                            <option value="german">German</option>
                                            <option value="dutch">Dutch</option>
                                            <option value="hebrew">Hebrew</option>
                                            <option value="sanskrit">Sanskrit</option>
                                            <option value="hindi">Hindi</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserCountry">Country</label>
                                        <select id="modalEditUserCountry" name="modalEditUserCountry"
                                            class="select2 form-select">
                                            <option value="">Select Value</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Canada">Canada</option>
                                            <option value="China">China</option>
                                            <option value="France">France</option>
                                            <option value="Germany">Germany</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Korea">Korea, Republic of</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Russia">Russian Federation</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center mt-1">
                                            <div class="form-check form-switch form-check-primary">
                                                <input type="checkbox" class="form-check-input" id="customSwitch10"
                                                    checked />
                                                <label class="form-check-label" for="customSwitch10">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                            <label class="form-check-label fw-bolder" for="customSwitch10">Use as a billing
                                                address?</label>
                                        </div>
                                    </div>
                                    <div class="col-12 pt-50 mt-2 text-center">
                                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            Discard
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Edit User Modal -->
                <!-- upgrade your plan Modal -->
                <div class="modal fade" id="upgradePlanModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-upgrade-plan">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5 pb-2">
                                <div class="mb-2 text-center">
                                    <h1 class="mb-1">Upgrade Plan</h1>
                                    <p>Choose the best plan for user.</p>
                                </div>
                                <form id="upgradePlanForm" class="row pt-50" onsubmit="return false">
                                    <div class="col-sm-8">
                                        <label class="form-label" for="choosePlan">Choose Plan</label>
                                        <select id="choosePlan" name="choosePlan" class="form-select"
                                            aria-label="Choose Plan">
                                            <option selected>Choose Plan</option>
                                            <option value="standard">Standard - $99/month</option>
                                            <option value="exclusive">Exclusive - $249/month</option>
                                            <option value="Enterprise">Enterprise - $499/month</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 text-sm-end">
                                        <button type="submit" class="btn btn-primary mt-2">Upgrade</button>
                                    </div>
                                </form>
                            </div>
                            <hr />
                            <div class="modal-body px-5 pb-3">
                                <h6>User current plan is standard plan</h6>
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="d-flex justify-content-center me-1 mb-1">
                                        <sup class="h5 pricing-currency text-primary pt-1">$</sup>
                                        <h1 class="fw-bolder display-4 text-primary me-25 mb-0">99</h1>
                                        <sub class="pricing-duration font-small-4 mt-auto mb-2">/month</sub>
                                    </div>
                                    <button class="btn btn-outline-danger cancel-subscription mb-1">Cancel
                                        Subscription</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ upgrade your plan Modal -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
