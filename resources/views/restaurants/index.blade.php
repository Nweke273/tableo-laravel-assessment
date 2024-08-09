@extends('layouts.app')
@section('content')
<style>
    .tables-container {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
        font-family: 'Arial', sans-serif;
    }

    thead {
        background-color: #007bff;
        color: gray;
    }

    th,
    td {
        padding: 12px 15px;
        border: 1px solid #ddd;
    }

    th {
        text-align: left;
        font-weight: bold;
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tbody tr:hover {
        background-color: #e9ecef;
    }

    .group-name {
        background-color: #e9ecef;
        font-weight: bold;
    }

    #tables-loader {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100px;
        /* Adjust height as needed */
    }

    #tables-loader .spinner-border {
        margin-top: 10px;
    }
</style>

<div id="main-wrapper">
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-lg-12 col-lg-9 col-md-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
                                    <div class="mb-3">
                                        <h4 class="card-title mb-1">Our Restaurants</h4>
                                        <small class="mb-0">Find a restaurant of your choice and view a reservation</small>
                                    </div>
                                </div>


                                <div class="card-body tab-content pt-3">
                                    <div class="tab-pane fade show active" id="monthly1">
                                        <div class="row gy-4" id="favourite-itemsContent">
                                            <?php $i = 1; ?>
                                            @foreach($restaurants as $restaurant)
                                            <div class="col-md-6 col-lg-4 mb-4">
                                                <div class="card border-light shadow-sm">
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('images/dish/pic' . $i++ . '.jpg') }}" class="card-img-top img-fluid rounded-top" alt="" style="max-height: 200px; object-fit: cover;">
                                                    </a>
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title mb-3">
                                                            <a class="text-dark" href="">{{ $restaurant->name ?? '' }}</a>
                                                        </h5>
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <button class="view-tables-btn btn btn-primary btn-sm btn-rounded px-4" data-id="{{ $restaurant->id }}" data-type="all">View Tables</button>
                                                            <button class="view-tables-btn btn btn-secondary btn-sm btn-rounded px-4" data-id="{{ $restaurant->id }}" data-type="active">Active Tables</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>

                                        <div class="tables-container mt-4">
                                            <div id="tables-loader" class="d-none">
                                                <h4>Loading tables...</h4>
                                                <div class="spinner-border" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                            <!-- Tables will be inserted here -->
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection