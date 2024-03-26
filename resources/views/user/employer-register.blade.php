<x-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Looking for a an employee ?</h1>
                <h3>Please create an account</h3>
                <img src="/image/register.jpg" alt="img" width="100" height="100">
            </div>
            <div class="col-md-6">
                <div class="card" id="card">
                    <div class="card-header">Employer Registeration</div>
{{--                    <form action="{{route('store.employer')}}" method="POST">--}}
                    <form action="#" method="POST" id="registrationForm">
{{--                        @csrf--}}
                        <div class="card-body" >
                            <div class="form-group">
                                <label for="full-name">Company Name</label>
                                <input type="text" name="name" class="form-control" required id="full-name">
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" name="email" class="form-control" required id="Email">
                                @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" name="password" class="form-control" required id="pass">
                                @if($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-primary" id="btnRegister">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="message"></div>
            </div>
        </div>
    </div>
    <script>
        var url = "{{route('store.employer')}}";
        document.getElementById("btnRegister").addEventListener("click", function(event) {
            var form = document.getElementById("registrationForm");
            var card = document.getElementById("card");
            var messageDiv = document.getElementById('message')
            messageDiv.innerHTML = ''
            var formData = new FormData(form)

            var button = event.target
            button.disabled = true;
            button.innerHTML = 'Sending email.... '

            fetch(url, {
                method: "POST",
                headers:{
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                body: formData
            }).then(response => {
                if(response.ok) {
                    return response.json();
                }else{
                    throw new Errror('Error')
                }
            }).then(data=> {
                button.innerHTML = 'Register'
                button.disabled = false
                messageDiv.innerHTML = '<div class="alert alert-success">Registration was successful.Please check your email to verify it</div>'
                card.style.display = 'none'
            }).catch(error => {
                button.innerHTML = 'Register'
                button.disabled = false
                messageDiv.innerHTML = '<div class="alert alert-danger">Something went wrong. Please try again</div>'

            })


        })
    </script>
</x-layout>
