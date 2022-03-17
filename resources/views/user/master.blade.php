<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/chartist/chartist.min.cs') }}s">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex align-items-center">
          <a class="navbar-brand brand-logo" href="{{ url('/author') }}">
            <img src="{{ asset('admin/images/logo.svg') }}" alt="logo" class="logo-dark" />
          </a>
          <a class="navbar-brand brand-logo-mini" href=""><img src="{{ asset('admin/images/logo-mini.svg') }}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
          <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome software Maker dashboard!</h5>
          <ul class="navbar-nav navbar-nav-right ml-auto">









<style>


.button {
  font-size: 1em;
  padding: 10px;
  color: #34c54c;
  border: 2px solid #06D85F;
  border-radius: 20px/50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: #06D85F;
}

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
 float: right;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 70px auto;
  padding: 20px;

  border-radius: 5px;
  width: 30%;
  position: relative;

}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
.main-div{
	width:100%;
	height:100%;
	margin:0;
	padding:0;
	font-family: 'Noto Serif', serif;
}
*{box-sizing:border-box;font: bold 14px Arial, sans-serif;}


.main-div{
	 width:290px;
	 margin:0 auto;
	 background:#3F475B;
	 height:345px;
	 box-shadow:2px 2px 2px gray;
	 padding:15px;
	 border-bottom:5px solid #ED586C;
     border-radius:4px;
position:relative;
}

.screen-div,.number-div{
	  padding:0;
	  margin:0;
}

.screen{
	list-style:none;
	color:white;
	height:45px;
	width:58px;
  margin-left:8px;
	border-radius:4px;
	border-top:4px solid #828A9B;
	text-align:center;
	font-weight:bold;
	font-family: 'Ubuntu', sans-serif;
	margin-bottom:8px;
  width:182px;
	background:#828A9B;
   border-top:4px solid #ED586C;
  overflow:hidden;
}

.clear{
    width:60px;
	background:#7B8D8E;
	padding:10px 17px;
	position:absolute;
	border-radius:3px;
	left:215px;
	top:18px;
	color:white;
	cursor:pointer;
	text-align:center;
}
.screen{

}


.number-div li{
	 list-style:none;
	 float:left;
     width:52px;
    background:white;
	margin:9px 5px;
	padding:10px;
	border-bottom:4px solid #828A9B;
	border-radius:5px;
	color:#888888;
	text-align:center;
	transition:.2s;
	cursor:pointer;
}

.number-div li:hover{
	background: #44B3C2;
	border-bottom: 4px solid #336699;
	color: white;
}

#equals{
	background:#F43341;
	color:white;
}

#equals:hover{
	background: #FE5E6A;
	border-bottom: 4px solid #B3232E;
	color: white;
}


</style>


<script>window.onload = function (){
	var elements = document.getElementsByTagName("li");
	var screen = document.querySelectorAll(' p')[0];
	var clear =   document.getElementsByClassName('clear')[0];

	for(var i=0;i<elements.length;i+=1){
		  if(elements[i].innerHTML === '='){
			    elements[i].addEventListener("click", calculate(i));
		  }else{
			   elements[i].addEventListener("click", addtocurrentvalue(i));
		  }
	}




	function addtocurrentvalue (i){
		return function(){
			if (elements[i].innerHTML === "÷") {
               screen.innerHTML  +=  "/ " ;
      }else if(elements[i].innerHTML === "x"){
			      screen.innerHTML += "*";
		   } else{
			   screen.innerHTML  += elements[i].innerHTML;
		   }
	  };
   }



   clear.onclick = function () {
    screen.innerHTML = '';
  };

 function calculate(i) {
    return function () {
        screen.innerHTML = eval(screen.innerHTML);
    };
  }
};</script>

            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle ml-2" src="{{ asset('admin/images/faces/face8.jpg') }}" alt="Profile image"> <span class="font-weight-normal">{{ Auth::user()->name}}</span></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">

                <a href="{{ route('profile.show') }}" class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile </a>
                {{-- <a class="dropdown-item"><i class="dropdown-item-icon icon-speech text-primary"></i> Messages</a>
                <a class="dropdown-item"><i class="dropdown-item-icon icon-energy text-primary"></i> Activity</a>
                <a class="dropdown-item"><i class="dropdown-item-icon icon-question text-primary"></i> FAQ</a> --}}
                <a  href="{{ route('logout') }}" class="dropdown-item"><i class="dropdown-item-icon icon-power text-primary"></i>
                     <form method="POST" action="{{ route('logout') }}">
                    @csrf <input type="submit" value="logout">  </form> </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                    {{-- <div class="profile-image">
                    <img class="img-xs rounded-circle" src="{{ asset('admin/images/faces/face8.jpg') }}" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                    </div> --}}


              </a>
            </li>
            <li class="nav-item nav-category">
              <span class="nav-link">Dashboard</span>
            </li>





            <li class="nav-item nav-category"><span class="nav-link">UI Elements</span></li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Setup Menu</span>
                <i class="icon-settings menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item nav-category"><span class="nav-link">Basic setup</span></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/cat') }}">Category</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/subcat') }}">Sub Category</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/brand') }}">Brand</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/producttype') }}">Product Type</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/unit') }}">Unit</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/color/create') }}">Color</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/size/create') }}"> Size</a></li>
                <li class="nav-item nav-category"><span class="nav-link">Product Setup</span></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/productadd') }}">Add Product</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/color') }}">Products Color</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/size') }}">Products Size</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/image') }}">Products Image</a></li>
                <li class="nav-item nav-category"><span class="nav-link">Banner Setup</span></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/banner') }}">Add Banner</a></li>


                </ul>
              </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ url('/product') }}">
                  <span class="menu-title">Products</span>
                  <i class="icon-globe menu-icon"></i>
                </a>
              </li>
              <li class="nav-item nav-category"><span class="nav-link">POS </span></li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/poshome') }}">
                  <span class="menu-title">POS</span>
                  <i class="icon-user menu-icon"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/guestlist') }}">
                  <span class="menu-title">Guests</span>
                  <i class="icon-user menu-icon"></i>
                </a>
              </li>
              <li class="nav-item nav-category"><span class="nav-link">ONLINE CUSTOMER </span></li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/customer') }}">
                  <span class="menu-title">Customers</span>
                  <i class="icon-user menu-icon"></i>
                </a>
              </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/customer/order') }}">
                  <span class="menu-title">Orders</span>
                  <i class="icon-bag menu-icon"></i>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ url('/customer/order/ontheway') }}">
                  <span class="menu-title">Orders On the way</span>
                  <i class="icon-plane menu-icon"></i>
                </a>
              </li><li class="nav-item">
                <a class="nav-link" href="{{ url('/customer/order/delivered') }}">
                  <span class="menu-title">Orders Delivered</span>
                  <i class="icon-location-pin menu-icon"></i>
                </a>
              </li>



              <li class="nav-item">
                <a class="nav-link" href="{{ url('/sell/history') }}">
                  <span class="menu-title">Sell History</span>
                  <i class="icon-disc menu-icon"></i>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ url('/dailycost') }}">
                  <span class="menu-title">Extra Cost list</span>
                  <i class="icon-compass menu-icon"></i>
                </a>
              </li>

               <li class="nav-item nav-category"><span class="nav-link">Replacce Product</span></li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/purchase/agent') }}">
                  <span class="menu-title">Product replace</span>
                  <i class="icon-bag menu-icon"></i>
                </a>
              </li>





 <li class="nav-item">
              <a class="nav-link" href="pages/icons/simple-line-icons.html">
                <span class="menu-title">Icons</span>
                <i class="icon-globe menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Form Elements</span>
                <i class="icon-book-open menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/charts/chartist.html">
                <span class="menu-title">Charts</span>
                <i class="icon-chart menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-title">Tables</span>
                <i class="icon-grid menu-icon"></i>
              </a>
            </li>
            <li class="nav-item nav-category"><span class="nav-link">Sample Pages</span></li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">General Pages</span>
                <i class="icon-doc menu-icon"></i>
              </a>
               <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item pro-upgrade">
              <span class="nav-link">
                <a class="btn btn-block px-0 btn-rounded btn-upgrade" href="https://www.bootstrapdash.com/product/stellar-admin-template/" target="_blank"> <i class="icon-badge mx-2"></i> Upgrade to Pro</a>
              </span>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">

            <script>
                function myFunction(A) {

                    return confirm(A);

                }



$(function() {
var Accordion = function(el, multiple) {
this.el = el || {};
this.multiple = multiple || false;

var links = this.el.find('.article-title');
links.on('click', {
el: this.el,
multiple: this.multiple
}, this.dropdown)
}

Accordion.prototype.dropdown = function(e) {
var $el = e.data.el;
$this = $(this),
$next = $this.next();

$next.slideToggle();
$this.parent().toggleClass('open');

if (!e.data.multiple) {
$el.find('.accordion-content').not($next).slideUp().parent().removeClass('open');
};
}
var accordion = new Accordion($('.accordion-container'), false);
});
</script>




            @yield('content')
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © <a href="">softwaremaker.com</a> {{ date('Y') }}</span>
              {{--  <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>  --}}
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/vendors/chartist/chartist.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('admin/js/dashboard.js') }}"></script>

    {{-- TinyMce --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
        selector: 'textarea.tinymce-editor',
        height: 500,
        menubar: false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
        content_css: '//www.tiny.cloud/css/codepen.min.css'
      });
          </script>
    <!-- End custom js for this page -->
  </body>
</html>
