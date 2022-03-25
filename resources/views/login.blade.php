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

<div class="row">
    {{-- PAGE IMAGE --}}
   <div class="col-lg-6" id="login-img">
   </div>
   {{-- FORM --}}
   <div class="col-lg-6 col-12 py-5" id="form-user">
       <div class="container">
           {{-- LOGO --}}
           <div class="row d-flex justify-content-center mb-5 mb-lg-0">
               <div class="col-lg-2 col-3">
                   <img src="/images/main/logo2.png" class="img-fluid" id="form-logo">
               </div>
           </div>
               {{-- LOGIN FORM --}}
           <div class="row  m-xxl-5 m-md-3 p-xxl-5 p-md-3 bg-light rounded shadow justify-content-center">
               <h2 class="text-center fw-bold mt-4"><b class="text-blue"> LOGIN TO YOUR ACCOUNT</b></h2>
            
                <div class="col-9 py-5">
                    @if(Session::has('flash_error'))
                    <div class="alert alert-danger">{{Session::get('flash_error')}}</div>
                    @endif
    
                    <div class="px-2">
                        <form action="{{ route('login')}}" method="POST" >
                            {{ csrf_field() }}        
                            <div class="form-group">                
                                <label class="login-label">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="">
                                <span>{{$errors->first('email')}}</span>
                            </div>
                            <div class="form-group">                
                                <label class="login-label">Enter Password</label>
                                <input type="password" name="password" class="form-control" placeholder="">
                                <span>{{$errors->first('password')}}</span>
                            </div>
                            <br/>
                            <div class="text-center">
                                <button type="submit" class="btn btn-login border rounded form-control">Login</button>
                            </div>
                        <br/>
                        </form>
                    </div>

                   </div>
          
              
           </div>
       </div>
   </div>
</div>
    
@endsection