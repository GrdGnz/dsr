@extends('layouts.app')

@section('content')

@include('layouts.topbar')

<div id="layoutSidenav">

    <div id="layoutSidenav_nav">
        @include('layouts.sidenav')
    </div>

    <div id="layoutSidenav_content">

        <!-- Main content area -->
        <main class="col-lg-9 px-md-4 p-3">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">{{ __('Dashboard') }}</h1>
            </div>

            <div class="row p-3">
                <div class="col-md-12">

                    <div class="row p-3">

                        <!-- Amadeus Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-green text-white">
                                <div class="card-header">
                                    <h5 class="card-title">Amadeus</h5>
                                </div>
                                <div class="card-body">
                                    <table align="center" class="table-striped table-transparent text-white">
                                        <tbody>
                                            <tr>
                                                <td width="70%"><strong>Total Issued: </strong></td>
                                                <td>500</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Invoice</strong></td>
                                                <td>$50,000</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Fare</strong></td>
                                                <td>$40,000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Sabre Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-red text-white">
                                <div class="card-header">
                                    <h5 class="card-title">Sabre</h5>
                                </div>
                                <div class="card-body">
                                    <table align="center" class="table-striped table-transparent text-white">
                                        <tbody>
                                            <tr>
                                                <td width="70%"><strong>Total Issued: </strong></td>
                                                <td>450</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Invoice</strong></td>
                                                <td>$45,000</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Fare</strong></td>
                                                <td>$35,000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Cebu Pacific Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-blue text-white">
                                <div class="card-header">
                                    <h5 class="card-title">Cebu Pacific</h5>
                                </div>
                                <div class="card-body">
                                    <table align="center" class="table-striped table-transparent text-white">
                                        <tbody>
                                            <tr>
                                                <td width="70%">Total Issued: </td>
                                                <td>600</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Invoice</strong></td>
                                                <td>$60,000</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Fare</strong></td>
                                                <td>$50,000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- AIR ASIA Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-orange text-white">
                                <div class="card-header">
                                    <h5 class="card-title">AIR ASIA</h5>
                                </div>
                                <div class="card-body">
                                    <table align="center" class="table-striped table-transparent text-white">
                                        <tbody>
                                            <tr>
                                                <td width="70%"><strong>Total Issued: </strong></td>
                                                <td>700</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Invoice</strong></td>
                                                <td>$70,000</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Fare</strong></td>
                                                <td>$60,000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- AIR SWIFT Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-purple text-white">
                                <div class="card-header">
                                    <h5 class="card-title">AIR SWIFT</h5>
                                </div>
                                <div class="card-body">
                                    <table align="center" class="table-striped table-transparent text-white">
                                        <tbody>
                                            <tr>
                                                <td width="70%"><strong>Total Issued: </strong></td>
                                                <td>550</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Invoice</strong></td>
                                                <td>$55,000</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Fare</strong></td>
                                                <td>$45,000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- TBO AIR Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-teal text-white">
                                <div class="card-header">
                                    <h5 class="card-title">TBO AIR</h5>
                                </div>
                                <div class="card-body">
                                    <table align="center" class="table-striped table-transparent text-white">
                                        <tbody>
                                            <tr>
                                                <td width="70%"><strong>Total Issued: </strong></td>
                                                <td>800</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Invoice</strong></td>
                                                <td>$80,000</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Fare</strong></td>
                                                <td>$70,000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </main>

    </div>
</div>

<style>
    /* Custom styles for card titles */
    .card-title {
      font-size: 1.5rem;
      text-transform: uppercase;
    }

    /* Custom styles for small content in card body */
    .card-body p {
      font-size: 0.875rem; /* Adjust the font size as needed */
    }

    /* Custom styles for card header background colors */
    .bg-green {
      background-color: #28a745; /* Green */
    }

    .bg-red {
      background-color: #dc3545; /* Red */
    }

    .bg-blue {
      background-color: #007bff; /* Blue */
    }

    /* Unique background colors for additional cards */
    .bg-orange {
      background-color: #fd7e14; /* Orange */
    }

    .bg-purple {
      background-color: #6f42c1; /* Purple */
    }

    .bg-teal {
      background-color: #008080; /* Teal */
    }

    /* Custom styles for transparent tables with white text */
    .table-transparent {
      background-color: transparent !important;
      color: white !important;
    }
</style>

<!-- Include Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
