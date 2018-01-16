<!-- Modal -->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="tabs">
       <!-- Nav tabs -->
       <ul class="nav nav-tabs login" role="tablist">
         <li role="presentation" class="active"><a href="#login" aria-controls="home" role="tab" data-toggle="tab">Login</a></li>
         <li role="presentation"><a href="#register" aria-controls="profile" role="tab" data-toggle="tab">Register</a></li>
       </ul>

       <!-- Tab panes -->
       <div class="tab-content">
         <div role="tabpanel" class="tab-pane fade in active" id="login">

           <form class="form-horizontal" role="form" method="POST" action="http://localhost:8000/login">
               <input type="hidden" name="_token" value="MDZBhXFcD4Emx47MP6tM9elhdTxyBgmHFqcpFCKF">

               <div class="form-group">
                   <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                   <div class="col-md-6">
                       <input id="email" type="email" class="form-control" name="email" value="" required autofocus>

                                              </div>
               </div>

               <div class="form-group">
                   <label for="password" class="col-md-4 control-label">Password</label>

                   <div class="col-md-6">
                       <input id="password" type="password" class="form-control" name="password" required>

                                              </div>
               </div>

               <div class="form-group">
                   <div class="col-md-6 col-md-offset-4">
                       <div class="checkbox">
                           <label>
                               <input type="checkbox" name="remember" > Remember Me
                           </label>
                       </div>
                   </div>
               </div>

               <div class="form-group">
                   <div class="col-md-8 col-md-offset-4">
                       <button type="submit" class="btn btn-primary">
                           Login
                       </button>

                       <a class="btn btn-link" href="http://localhost:8000/password/reset">
                           Forgot Your Password?
                       </a>
                   </div>
               </div>
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
           </form>






         </div>
         <div role="tabpanel" class="tab-pane fade" id="register">

           <form class="form-horizontal" role="form" method="POST" action="http://localhost:8000/register">
               <input type="hidden" name="_token" value="MDZBhXFcD4Emx47MP6tM9elhdTxyBgmHFqcpFCKF">

               <div class="form-group">
                   <label for="name" class="col-md-4 control-label">Name</label>

                   <div class="col-md-6">
                       <input id="name" type="text" class="form-control" name="name" value="" required autofocus>

                                              </div>
               </div>

               <div class="form-group">
                   <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                   <div class="col-md-6">
                       <input id="email" type="email" class="form-control" name="email" value="" required>

                                              </div>
               </div>

               <div class="form-group">
                   <label for="password" class="col-md-4 control-label">Password</label>

                   <div class="col-md-6">
                       <input id="password" type="password" class="form-control" name="password" required>

                                              </div>
               </div>

               <div class="form-group">
                   <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                   <div class="col-md-6">
                       <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                   </div>
               </div>

               <div class="form-group">
                   <div class="col-md-6 col-md-offset-4">
                       <button type="submit" class="btn btn-primary">
                           Register
                       </button>
                   </div>
               </div>
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
           </form>


         </div>
       </div>
     </div>

     </div>
   </div>
 </div>
 <!-- modal close button -->

<div style="background-image:url('https://scontent.fbom1-1.fna.fbcdn.net/v/t34.0-12/17495532_1375854095813148_1424036561_n.jpg?oh=90a93a8b112abbeb6b9318dd3557dbee&oe=58D7E03F'); height:400px; background-size:cover;">
  <div  style="width:100%;background:rgba(0,0,0,0.7) ;height:400px;">
<div class="container">
  <div class="row">
<div class="col-md-2">
<!-- Button trigger modal -->
@if (Auth::guest())
  <button type="button" class="btn btn-success top" data-toggle="modal" data-target="#myModal">Login</button>
@else
  <div class="dropdown">
    <button class="btn btn-success dropdown-toggle top" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
      {{ Auth::user()->name }}
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
      {{-- <li><a href="#">Profile</a></li> --}}
      <li>
        <a href="{{ url('/profile') }}">Profile</a>
        <a href="{{ url('/logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </li>
    </ul>
  </div>
@endif
</div>
<div class="col-md-10">
<a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle top"><i class="fa fa-bars"></i></a>

<nav id="sidebar-wrapper">
<ul class="sidebar-nav">
  <a id="menu-close" href="#" class="btn btn-danger pull-right hidden-md hidden-lg toggle"><i class="fa fa-times"></i></a>
  <li class="sidebar-brand">
    <a href="{{ url('/profile') }}"><img src="../img/logo.png"></a>
  </li>
  <li>
    <a href="{{ url('/') }}" title="Navigate to Jonathan Adcox IT Resume">Home</a>
  </li>
  <li>
    <a href="http://localhost:8000/#about" title="Go to About Us section">About</a>
  </li>
  <li>
    <a href="{{url('/buy')}}" title="Navigate to Jonathan Adcox IT Resume">Buy</a>
  </li>
  <li>
    <a href="{{url('/sell')}}" title="Navigate to 'Our Services' section">Sell</a>
  </li>
  <!-- Future Development
  <li>
  <a href="#portfolio">Portfolio</a>
</li> -->
<a data-href="#" data-href="#collapseTwo" data-toggle="collapse" data-parent="#accordion" data-target="#collapseTwo" style="cursor:pointer;"></a>
</li>
</ul>
</nav>

</div>
</div>
