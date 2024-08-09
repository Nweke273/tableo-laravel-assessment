@extends('layouts.app')
@section('content')
<div id="main-wrapper">
    <div class="container-fluid text-center mt-5 mb-5">
        <h1>WELCOME TO TABLEO</h1>
    </div>
    <div class="container-fluid d-flex justify-content-center align-items-center mt-5">

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6 mb-4">
                    <div class="widget-stat card">
                        <a href="/restaurants">
                            <div class="card-body p-4">
                                <div class="media ai-icon">
                                    <span class="me-3 bgl-warning text-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-restaurant">
                                            <path d="M7 4V1H5v3M15 1v3h-2V4M2 20h4V9H2v11zM8 20h4V9H8v11zM14 20h4V9h-4v11zM20 20h4V9h-4v11zM7 20h2V9H7v11zM11 20h2V9h-2v11z"></path>
                                        </svg>
                                    </span>
                                    <div class="media-body">
                                        <h4 class="mb-0">View Restaurants</h4>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6 mb-4">
                    <div class="widget-stat card">
                        <a href="/quotes-page">
                            <div class="card-body p-4">
                                <div class="media ai-icon">
                                    <span class="me-3 bgl-danger text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open">
                                            <path d="M4 19V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13M4 6h16M4 6h16M4 19h16"></path>
                                            <path d="M4 6h16M4 19h16"></path>
                                        </svg>
                                    </span>
                                    <div class="media-body">
                                        <h4 class="mb-0">Read Quotes</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection