@extends('layouts.app')
@section('content')
<style>
    #quotes-list {
        font-family: 'Georgia', serif;
        /* Use a serif font for a more traditional quote look */
        font-size: 1.2em;
        /* Increase font size slightly */
        color: #333;
        /* Darker color for better readability */
    }

    .quote-item {
        border-left: 4px solid #007bff;
        /* Blue left border */
        padding-left: 15px;
        /* Padding to the left of the quote */
        margin-bottom: 10px;
        /* Space between quotes */
        background-color: #f9f9f9;
        /* Light background for quotes */
        border-radius: 5px;
        /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Subtle shadow for depth */
    }

    .quote-item p {
        margin: 0;
        /* Remove default margin */
        font-style: italic;
        /* Italicize the text */
    }
</style>
<div id="main-wrapper" class="container-fluid full-height d-flex justify-content-center align-items-center mt-5">
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