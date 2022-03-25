<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Icons and Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet'>
     <link rel="stylesheet" href="/css/home.css">
     <link rel="shortcut icon" href="/images/main/favicon.ico" type="image/x-icon">
     <title>Headaway</title>
  </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light color-y shadow sticky-top">
       <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}"> <img src="/images/main/logo2.png" width="50" height="50" class="mx-lg-3"></a>
          <h4 class="font-weight-bold mt-2 hide-small"> Headaway Salon</h4>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mt-2 ml-lg-5">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ url('/') }}"><h6 class="text-dark">Home</h6></a>
                </li>
                <li class="nav-item mx-2">
                  <a class="nav-link" href="{{ url('/services') }}"><h6 class="text-dark">Services</h6></a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ url('/gallery') }}"><h6 class="text-dark">Gallery</h6></a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ url('/contact') }}"><h6 class="text-dark">Contact Us</h6></a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ url('/about') }}"><h6 class="text-dark">About Us</h6></a>
                  </li>
              </ul>
              <a href="https://www.facebook.com/headawaysalon" target="_blank" class="btn btn-primary color-b float-right ml-lg-3">Book Now!</a>
          </div>
       </div>
       
      </nav>

        <div class="content">
            @yield('main-content')
        </div>


          {{-- Footer --}}
      <footer id="footer-items">
        <div class="container-fluid color-y">
         <div class="row p-lg-5 py-5 px-3">
          <div class="col-lg-1 col-0"></div>
            <div class="col-lg-3 col-6 mt-3 ">
              <h4 class="font-weight-bold"><a class="text-dark" href="{{ url('/services') }}"><b>SERVICES</b></a></h4>
              <h6 class="mt-2"><a class="text-dark" href="{{ url('/services') }}">Haircut</a></h6>
              <h6 class="mt-2"><a class="text-dark" href="{{ url('/services') }}">Treatments</a></h6>
              <h6 class="mt-2"><a class="text-dark" href="{{ url('/services') }}">Technical</a></h6>
              <h6 class="mt-2"><a class="text-dark" href="{{ url('/services') }}">Coloring</a></h6>
              <h4 class="font-weight-bold mt-3"><b>OUR HAPPY CLIENTS</b></h4>
              <h6 class="mt-2"><a class="text-dark" href="{{ url('/gallery') }}">Gallery</a></h6>
              <h6 class="mt-2"><a class="text-dark" href="{{ url('/') }}">Our Procedures to Fight COVID-19</a></h6>
            </div>
            <div class="col-lg-4 col-6 mt-3" >
            <h4 class="font-weight-bold"><a class="text-dark" href="{{ url('/contact') }}"><b>CONTACT US</b></a></h4>
            <h6 class="mt-2"><a class="text-dark" href="">+(639) 61533-3163</a></h6>
            <h4 class="font-weight-bold mt-3"><b>ADDRESS</b></h4>
            <h6 class="mt-2">Calamba, Calabarzon, Philippines 4027 Calamba, Philippines</h6>
            
            </div>
            <div class="col-lg-4 col-12 d-flex align-items-center">            
              <div class="container">
                  <div class="row">
                    <div class="container text-center">
                      <img src="/images/main/logo2.png" alt="" class="img-fluid" id="logo_footer">
                      <h4 class="mt-3 text-break font-weight-bold">Headaway Salon</h4>
                    </div>
                </div>
              </div>
        </div>
         </div>
       
         <div class="row color-b text-light py-3 px-5">
           © 2021 Headaway Salon. All Rights Reserved.
         </div>
        </div>
       </footer>
 
        
      
       <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    

   </body>
</html>