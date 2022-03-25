@extends('template.main')

@section('main-content')

<style>
   #about_banner{
    background-image: linear-gradient(180deg, transparent, transparent, transparent, #FFFFFF),  url("/images/main/home.jpg");
    background-size: cover;
    background-position: center;
    height:40vh;
    color: black;
}

</style>
<section class="p-5 mb-5" id="about_banner">

  </section>

  <div class="container my-5 pb-5 text-center">
   <h1 class="font-weight-bold mb-2"> About Us</h1>
   <div class="row mt-3 justify-content-center">
       <div class="card col-lg-3 col-11 shadow color-b text-light p-lg-4 p-3 mt-3 mr-lg-3">
           <h2 class="font-weight-bold">Our Business</h2>
           <p>We are the 1st salon in Calamba, Santa Rosa, Laguna to Introduce the Japan's well known scalp treatment the Soda Scalp Treatment.</p>
        </div>   
        <div class="card col-lg-3 col-11 shadow color-b text-light p-lg-4 p-3 mt-3 mr-lg-3 ">
           <h2 class="font-weight-bold">Quality over Quantity</h2>
           <p>Providing exceptional service to our clients. Striving to do better, or the best to satisfy our customers. The value matters more than the volume. We may not be everywhere at once or pretty large(yet) but know that our services will leave you satisfied. So head along to Headaway Salon.</p>
        </div>
        <div class="card col-lg-3 col-11 shadow color-b text-light p-lg-4 p-3 mt-3">
           <h2 class="font-weight-bold">Safety</h2>
           <p>We clean our styling station chair and hair washing basin after each client. We work with single-use fabrics for each client. We clean and sanitize all tools after each client. We maintain a physical distance of at least 1-2 meter at the styling station. We clean all salon surfaces minimum 3 times per day.</p>
        </div>
   </div>
 </div>
</div>
    
@endsection