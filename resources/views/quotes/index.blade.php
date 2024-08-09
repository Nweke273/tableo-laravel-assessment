@extends('layouts.app')
@section('content')

<div id="main-wrapper" class="container-fluid d-flex justify-content-center align-items-center mt-5">
    <div id="loader-text">
        <h3 class="text-primary">Fetching Quotes.....</h3>
    </div>

    <div id="quote">
        <h1 class="mb-4" style="width: 50%;">Kanye West Quotes</h1>
        <div id="quotes-list" class="mb-3"></div>
        <div class="col-md-12">
            <button id="refresh-quotes" class="btn btn-primary col-md-6 mt-3">
                <span id="button-text">Refresh Quotes</span>
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</div>
@endsection