@extends('template.main')

@section('main-content')

<style>
#spacer{
    height:58%;
}
@media screen and (max-width:991px){
    #spacer{
        display:none;
    }
}
@media screen and (min-width:768px){
    .title-head {
        color: black;
        -webkit-text-fill-color: white; 
        -webkit-text-stroke-width: 2px;
        -webkit-text-stroke-color: black;
    }
}
</style>

<div class="container-fluid" id="banner">
    <div class="row" id="spacer"></div>
    <div class="row">
        <div class="col-lg-3 col-0">&nbsp;</div>
      <div class ="col-lg-9 col-12 p-5" id = "bannertext">
       <div class="container ml-lg-5 p-lg-5 text-lg-right text-center">
            <h1 class="title-head"> Best Salon in Town! </h1>               
            <h5 class="mr-lg-3">
                Look fabulous for just cheap.
            </h5>    
       </div>
      </div>
      
    </div>
  
  </div>

  <div class="container-fluid pt-3 pb-5 p-lg-3">
          <div class="container">
              <h1 class="text-center pb-5 font-weight-bold">We Offer the Best Services</h1>
              <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 col-12 mt-lg-0 mt-3">
                    <div class="card">
                        <img class="card-img-top" src="/images/main/haircut.jpg" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Regular</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">Haircuts/Blowdry</li>
                          <li class="list-group-item">Shampoo/Ironing</li>
                          <li class="list-group-item">Eyebrow Shaving</li>
                        </ul>
                        <div class="card-body">
                          <a href="{{ url('/services') }}" class="card-link">See Prices</a>
                          <a href="{{ url('gallery') }}" class="card-link">Gallery</a>
                        </div>
                      </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mt-lg-0 mt-3">
                    <div class="card">
                        <img class="card-img-top" src="/images/main/Treatment.jpg" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Treatments</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">Scalp Cleansing</li>
                          <li class="list-group-item">Collagen</li>
                          <li class="list-group-item">Mask Treatment</li>
                        </ul>
                        <div class="card-body">
                          <a href="{{ url('/services') }}" class="card-link">See Prices</a>
                          <a href="{{ url('gallery') }}" class="card-link">Gallery</a>
                        </div>
                      </div>
                </div>
                 <div class="col-lg-3 col-md-6 col-12 mt-lg-0 mt-3">
                    <div class="card">
                        <img class="card-img-top" src="/images/main/Rebond.jpg" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Technical</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Rebonding</li>
                            <li class="list-group-item">Perming</li>
                          <li class="list-group-item">Brazilian Blowout</li>
                        </ul>
                        <div class="card-body">
                          <a href="{{ url('/services') }}" class="card-link">See Prices</a>
                          <a href="{{ url('gallery') }}" class="card-link">Gallery</a>
                        </div>
                      </div>
                 </div>
                 <div class="col-lg-3 col-md-6 col-12 mt-lg-0 mt-3">
                    <div class="card">
                        <img class="card-img-top" src="/images/main/Highlights.jpg" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold">Coloring</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">Cellophane</li>
                          <li class="list-group-item">Color/Bleaching</li>
                          <li class="list-group-item">Highlights(Foil/Traditional)</li>
                        </ul>
                        <div class="card-body">
                          <a href="{{ url('/services') }}" class="card-link">See Prices</a>
                          <a href="{{ url('gallery') }}" class="card-link">Gallery</a>
                        </div>
                      </div>
                 </div>
                
              </div>
          </div>

      </section>
  </div>

  <div class="container p-lg-3 my-5">
    <h1 class="text-center pb-5 font-weight-bold">Safety to Fight COVID-19</h1>
    <div class="row row-col-lg-3 justify-content-center">
        <div class="col-lg-4 mt-3">
            <img src="/images/main/health1.jpg" alt="" class="img-fluid rounded">
        </div>
        <div class="col-lg-4 mt-3">
            <img src="/images/main/health2.jpg" alt="" class="img-fluid rounded">
        </div>
        <div class="col-lg-4 mt-3">
            <img src="/images/main/health3.jpg" alt="" class="img-fluid rounded">
        </div>
        <div class="col-lg-4 mt-3">
            <img src="/images/main/health4.jpg" alt="" class="img-fluid rounded">
        </div>
        <div class="col-lg-4  mt-3">
            <img src="/images/main/health5.jpg" alt="" class="img-fluid rounded">
        </div>

    </div>
  </div>


  
@endsection