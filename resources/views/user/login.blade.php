<x-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                  @include('message')
                <div class="card shadow-lg">
                    <div class="card-header">Login</div>
                    <form action="{{route('postlogin')}}" method="POST">
                        @csrf
                        <div class="card-body">
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
                            <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
