<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-container content">
          <div class="navbar-collapse" id="navbar-mobile">
            <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
              <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
              </ul>
            </div>
            
          </div>
        </div>
      </div>
    </nav>
    <!-- <ul class="main-search-list-defaultlist d-none">
      <li class="d-flex align-items-center"><a class="pb-25" href="#">
          <h6 class="text-primary mb-0">Files</h6></a></li>
      <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
          <div class="d-flex">
            <div class="mr-50"><img src="app-assets/images/icons/xls.png" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>
            </div>
          </div><small class="search-data-size mr-50 text-muted">&apos;17kb</small></a></li>
      <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
          <div class="d-flex">
            <div class="mr-50"><img src="app-assets/images/icons/jpg.png" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd Developer</small>
            </div>
          </div><small class="search-data-size mr-50 text-muted">&apos;11kb</small></a></li>
      <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
          <div class="d-flex">
            <div class="mr-50"><img src="app-assets/images/icons/pdf.png" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing Manager</small>
            </div>
          </div><small class="search-data-size mr-50 text-muted">&apos;150kb</small></a></li> -->
      <!-- <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
          <div class="d-flex">
            <div class="mr-50"><img src="app-assets/images/icons/doc.png" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
            </div>
          </div><small class="search-data-size mr-50 text-muted">&apos;256kb</small></a></li>
      <li class="d-flex align-items-center"><a class="pb-25" href="#">
          <h6 class="text-primary mb-0">Members</h6></a></li>
      <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
          <div class="d-flex align-items-center">
            <div class="avatar mr-50"><img src="app-assets/images/portrait/small/avatar-s-8.jpg" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
            </div>
          </div></a></li>
      <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
          <div class="d-flex align-items-center">
            <div class="avatar mr-50"><img src="app-assets/images/portrait/small/avatar-s-1.jpg" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>
            </div>
          </div></a></li>
      <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
          <div class="d-flex align-items-center">
            <div class="avatar mr-50"><img src="app-assets/images/portrait/small/avatar-s-14.jpg" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing Manager</small>
            </div>
          </div></a></li>
      <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
          <div class="d-flex align-items-center">
            <div class="avatar mr-50"><img src="app-assets/images/portrait/small/avatar-s-6.jpg" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
            </div>
          </div></a></li>
    </ul>
    <ul class="main-search-list-defaultlist-other-list d-none">
      <li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100 py-50">
          <div class="d-flex justify-content-start"><span class="mr-75 feather icon-alert-circle"></span><span>No results found.</span></div></a></li>
    </ul>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto"><a class="navbar-brand" href="/">
              <div class="brand-logo"></div>
              <h2 class="brand-text mb-0">Dance Academy</h2></a></li>
        </ul>
      </div>
      <div class="shadow-bottom"></div>
      <div class="main-menu-content">






        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


      @if(Auth::guard('admin')->check())
      <li ><a href="/"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a></li>
          <li class=" nav-item"><a href="#"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Ecommerce">Location</span></a>
            <ul class="menu-content">
              <li><a href="/location/create"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Add Location</span></a>
              </li>
              <li><a href="/location"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">View Location</span></a>
              </li>
            </ul>
          </li>
          <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Ecommerce">Batch</span></a>
            <ul class="menu-content">
              <li><a href="/batch/create"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Add Batch</span></a>
              </li>
              <li><a href="/batch"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">View Batches</span></a>
              </li>
            </ul>
          </li>
          <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Ecommerce">Students</span></a>
            <ul class="menu-content">
              <li><a href="/student/register" target="_blank"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Add Students</span></a>
              </li>
              <li><a href="/students"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">View Students</span></a>
              </li>


              <li><a href="{{route('new-students')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">New Students</span></a>
              </li>

              <li><a href="{{route('deleted-students')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">Deleted Students</span></a>
              </li>

            </ul>
          </li>

          <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Ecommerce">Coupon Code</span></a>
            <ul class="menu-content">
              <li><a href="{{route('coupon-code.create')}}" target="_blank"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Add Coupon</span></a>
              </li>
              <li><a href="{{route('coupon-code.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">View Coupon</span></a>
              </li>
            </ul>
          </li>

          <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Ecommerce">Fees</span></a>
            <ul class="menu-content">
              <!-- <li><a href="/fees"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">Add Monthly Fees</span></a>
              </li> -->
              <li><a href="/fees"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">View Monthly Fees</span></a>
              </li>
              <li><a href="/fees-invoice-wise"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">View Monthly  Invoice Wise</span></a>
              </li>
            </ul>
          </li>
         
          <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Ecommerce">Attendance</span></a>
            <ul class="menu-content">
              <li><a href="/attendance/create"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Add Attendance</span></a>
              </li>
              <li><a href="/attendance"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">View Attendance</span></a>
              </li>
              <li><a href="{{route('registerview')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">Register View</span></a>
              </li>
              <!--  -->
            </ul>
          </li>
          <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Ecommerce">Custom Message</span></a>
            <ul class="menu-content">
              <li><a href="{{ route('custom-message') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Send Message</span></a>
              </li>
             
            </ul>
          </li>
          <li><a href="/logout"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Logout</span></a></li>
       
@elseif(Auth::guard('web')->check())
    <!-- Hi {{Auth::guard('web')->user()->name}} -->

    <li><a href="{{ route('userprofile') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Profile</span></a></li>
    <li><a href="{{ route('edit.userprofile') }}" target="_blank"> <i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Update Profile</span></a></li>

    <li><a href="{{ route('student.addbatch') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Enroll for New Batch</span></a></li>


    <li><a href="/user/fees-payments"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Check Fees Payment</span></a></li>
    <li><a href="/user/attendance"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Check attendance</span></a></li>
    <li><a href="/user/logout"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Logout</span></a></li>
@endif


          
         

         
        </ul>
      </div>
    </div>
    <!-- END: Main Menu-->