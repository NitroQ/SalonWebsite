@extends('template.main')


@section('main-content')


<style>
	#login-img{
        display: none;
        background-image: url('/images/main/home2.jpg');
        background-position: center;
        background-size: cover;
    }
	@media screen and (min-width:992px){
        #login-img{
            display: block;
        }
    }

     
</style>
{{-- CONTACT US BANNER --}}
<section id="background">
	<div class="container-fluid" >
		<div class="row justify-content-center">
			<div class="col-lg-6 col-0" id="login-img">
			</div>
			   {{-- FORM --}}
			   <div class="col-lg-6 col-12 py-5 my-lg-3">
				<div class="container">
						{{-- LOGIN FORM --}}
					<div class="row m-xxl-5 m-md-3 p-xxl-5 p-md-3 bg-light rounded shadow justify-content-center">
						<h2 class="text-center fw-bold mt-4"><b class="text-blue"> CONTACT US</b></h2>
					   <div class="col-10 mt-3">
						<div class="p-1 text-lg-left text-center">
							<div class="ml-lg-3">
								<h5 class="text-break"><i class="bi bi-house-fill mr-lg-2"></i>Calamba, Calabarzon, Philippines 4027 Calamba, Philippines</h5>
								<h5 class="my-4 text-break"><i class="bi bi-telephone-inbound-fill mr-lg-2"></i>+(639) 61533-3163</h5>
							</div>
			
							<div class="ml-lg-3 mt-5 mb-3">
								<h4>Visit us at..</h4>
								<h5 class="my-4 text-break"><i class="bi bi-facebook mr-lg-2"></i><a href="https://facebook.com/headawaysalon" target="_blank" class="text-decoration-none text-dark">facebook.com/headawaysalon</a></h5>
							</div>
						</div>
					   </div>
					   
					</div>
				</div>
			</div>

		</div>

	
	</div>
</section>

@endsection