@extends('layouts.app')
@section('content')

<div id="main-wrapper" class="container-fluid d-flex flex-column justify-content-center align-items-center mt-5 px-3">
    <div id="loader-text" class="text-center">
        <h3 class="text-primary">Fetching Quotes.....</h3>
    </div>

    <div id="quote" class="mt-5 text-center">
        <h1 class="mb-4">Kanye West Quotes</h1>
        <div id="quotes-list" class="mb-3"></div>
        <div class="w-100 d-flex justify-content-center">
            <button id="refresh-quotes" class="btn btn-primary mt-3">
                <span id="button-text">Refresh Quotes</span>
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</div>

@endsection
<script src="{{asset('js/quotes.js')}}"></script>
