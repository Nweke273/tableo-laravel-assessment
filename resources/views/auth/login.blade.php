@extends('layouts.app')
@section('content')
<style>
    .full-height {
        height: 100vh;
    }

    .elevation {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
<div class="container-fluid full-height d-flex justify-content-center align-items-center">
    <div class="col-md-4 col-lg-3">
        <div class="card elevation">
            <div class="card-body">
                <!-- Session Status -->
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Password -->
                    <div class="form-group">
                        <h3 class="mb-3 text-center">A password is required to access this page!!</h3>
                        <input id="password" class="form-control mt-1" type="password" name="password" required autocomplete="current-password" placeholder="Enter password" />
                        @error('password')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <!-- Uncomment this section if you want to add remember me functionality -->
                    <!--
                        <div class="form-check mt-4">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label">
                                Remember me
                            </label>
                        </div>
                        -->

                    <div class="d-flex justify-content-center mt-4">
                        <!-- Uncomment this section if you have a forgot password route -->
                        <!--
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif
                            -->

                        <button type="submit" class="btn btn-primary">
                            Continue
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection