@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css"  href="css/app.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/alert.css">
    <link href="images/favicon.png" rel="icon" type="image/png"> 
@endpush
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script>
    $(document).ready(function() {
        // Toggle password visibility
        $('#togglePassword').click(function() {
            var passwordInput = $('#password');
            var type = passwordInput.attr('type');
            
            if (type === 'password') {
                passwordInput.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        // Check if the user is already logged in
        @if(Auth::check())
            $('#userID').on('change', function() {
                var id = $(this).val();
                if (id) {
                    // Alert the user that they are already logged in
                    var userName = '{{ Auth::user()->name }}';
                    alert('You are already logged in as ' + userName + ' Please Click the Home button in the right Corner');
                    // Focus remains on the userID field
                    $(this).focus();
                }
            });
        @endif

        // AJAX call to fetch user details based on user ID
        $('#userID').on('change', function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "/get-user-details/" + id,
                    success: function(data) {
                        $('#name').val(data.name).prop('disabled', true); // Populate and disable other fields
                        $('#email').val(data.email).prop('disabled', true);
                        $('#designation').val(data.designation).prop('disabled', true);
                        $('#dep_name').val(data.dep_name).prop('disabled', true);
                        $('#password').focus(); // Shift focus to the password field
                    }
                });
            } else {
                $('#name').val('');
                $('#email').val('');
                $('#designation').val('');
                $('#dep_id').val('');
            }
        });
    });
</script>


<style>
    @media only screen and (max-width: 768px) {
    .signin-image{
        display: none;
    }
  /* Your CSS styles for mobile devices */
}
</style>
@endpush
 
@section('content')
<div class="main">
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="log-container">
        <div  class="logo"><img src="/images/p-1.png"  alt="logos"></div>
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>    
                </div>
                <div class="signin-form">
                    <div class="row p-2 justify-content-center " id="successMessage">
                        @if(session()->has('success'))
                        <div class="alert alert-success warning-msg">
                            <i class="fa fa-close"></i>
                            {{ session()->get('success') }}
                        </div>
                        @endif

                    </div>
                    <h2 class="form-title">Login</h2>
                    <form method="POST" action="{{ route('login') }}" class="register-form" id="login-form">
                        @csrf
                        {{-- <input type="hidden" name="application_id" value="{{ request('application_id') }}"> --}}
                        <div class="form-group">
                            <label for="userID"></label>
                            <input type="number"  id="userID" placeholder="Your ID" class="form-control @error('userID') is-invalid @enderror" name="userID" value="{{ old('userID') }}" required autocomplete="email" autofocus>
                            <div class="col-md-6">
                                @error('userID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text"  id="name" placeholder="Your Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <div class="col-md-6">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text"  id="email" placeholder="Your Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <div class="col-md-6">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="designation"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text"  id="designation" placeholder="Your Designation" class="form-control @error('designation') is-invalid @enderror" name="designation" value="{{ old('designation') }}" required autocomplete="designation" autofocus>
                            <div class="col-md-6">
                                @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dep_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text"  id="dep_name" placeholder="Your Department" class="form-control @error('dep_name') is-invalid @enderror" name="dep_name" value="{{ old('dep_name') }}" required autocomplete="dep_name" autofocus>
                            <div class="col-md-6">
                                @error('dep_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input id="password" type="password" placeholder="Your Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" autofocus>
                            <div class="col-md-6">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <i class="fas fa-eye eye-icon" id="togglePassword"></i>
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-submit">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div class="form-group">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                     {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- @push('script')
<script>
    $(document).ready(function() {
      $('#togglePassword').click(function() {
        var passwordInput = $('#password');
        var type = passwordInput.attr('type');
        
        if (type === 'password') {
          passwordInput.attr('type', 'text');
          $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          passwordInput.attr('type', 'password');
          $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        }
      });
    });
  </script>
@endpush --}}
@endsection
@prepend('scripts')
    @if(Auth::check())
        <script>
            $(document).ready(function() {
                $('#userID').on('change', function() {
                    console.log('Key pressed:', event.key);
                    if (event.key === 'Enter') {
                        event.preventDefault(); // Prevent the form from submitting
                        
                        // Check if the userID field is empty
                        if ($(this).val().trim() === '') {
                            var userName = '{{ Auth::user()->name }}';
                            alert('You are already logged in as ' + userName);
                        }
                    }
                });
            });
        </script>
    @endif

@endprepend()


