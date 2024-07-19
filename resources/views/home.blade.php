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

                            @if(isset($sources))
                                @foreach ($sources as $index => $source)
                                    @php
                                        $colors = ['bg-red', 'bg-green', 'bg-blue', 'bg-orange', 'bg-purple', 'bg-teal'];
                                        $color = $colors[$index % count($colors)];
                                    @endphp
                                    <div class="col-md-4 mb-4">
                                        <div class="card {{ $color }} text-white">
                                            <div class="card-header">
                                                <h5 class="card-title">{{ $source->DESCRIPTION }}</h5>
                                            </div>
                                            <div class="card-body txt-2">
                                                <table align="center" class="table-striped table-transparent text-white w-100">
                                                    <tbody>
                                                        <tr>
                                                            <td width="70%"><strong>Total Issued: </strong></td>
                                                            <td>{{ $totalIssuedCounts[$source->CODE] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Total Invoice: </strong></td>
                                                            <td>{{ $totalInvoiceCounts[$source->CODE] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Total Fare (PHP): </strong></td>
                                                            <td>{{ number_format($totalFareSumsPHP[$source->CODE], 2) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Total Fare (USD): </strong></td>
                                                            <td>{{ number_format($totalFareSumsUSD[$source->CODE], 2) }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

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
