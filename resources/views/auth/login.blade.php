@extends('layouts.app')
@section('content')

<div class="container-fluid full-height d-flex justify-content-center align-items-center">
    <div class="col-md-4 col-lg-3">
        <div class="card elevation">
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <h3 class="mb-3 text-center">A password is required to access this page!!</h3>
                        <input id="password" class="form-control mt-1" type="password" name="password" required autocomplete="current-password" placeholder="Enter password" />
                        @error('password')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            Continue
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection