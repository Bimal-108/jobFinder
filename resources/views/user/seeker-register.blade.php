<x-layout>
   <div class="container mt-5">
       <div class="row">
           <div class="col-md-6">
               <h1>Looking for a job ?</h1>
               <h3>Please create an account</h3>
               <img src="/image/register.jpg" alt="img" width="100" height="100">
           </div>
           <div class="col-md-6">
               <div class="card">
                   <div class="card-header">Register</div>
                   <form action="{{route('store.seeker')}}" method="POST">
                       @csrf
                   <div class="card-body">
                       <div class="form-group">
                           <label for="full-name">Full name</label>
                           <input type="text" name="name" class="form-control" id="full-name">
                           @if($errors->has('name'))
                               <span class="text-danger">{{ $errors->first('name') }}</span>
                               @endif
                       </div>
                       <div class="form-group">
                           <label for="Email">Email</label>
                           <input type="email" name="email" class="form-control" id="Email">
                           @if($errors->has('email'))
                               <span class="text-danger">{{ $errors->first('email') }}</span>
                           @endif
                       </div>
                       <div class="form-group">
                           <label for="pass">Password</label>
                           <input type="password" name="password" class="form-control" id="pass">
                           @if($errors->has('password'))
                               <span class="text-danger">{{ $errors->first('password') }}</span>
                           @endif
                       </div>
                       <br>
                       <div class="form-group">
                           <button class="btn btn-primary" type="submit">Register</button>
                       </div>
                   </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
</x-layout>
