@extends('layouts.app')

@section('content')

@include('layouts.topbar')

<div id="layoutSidenav">

    <div id="layoutSidenav_nav">
        @include('layouts.sidenav')
    </div>

    <div id="layoutSidenav_content">

        <!-- Main content area -->
        <main class="p-5">
            <div class="row">
                <h1 class="h2">{{ __('Data') }}</h1>
            </div>

            <!-- Search Parameters Card -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Parameters</h5>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="parametersToggleSwitch" data-on-text="Show" data-off-text="Hide" data-toggle="switch">
                        <label class="custom-control-label" for="parametersToggleSwitch"></label>
                    </div>
                </div>
                <div class="card-body" id="parametersCardBody">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="year">Year:</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="year" id="year2023">
                                <label class="form-check-label" for="year2023">2023</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="year" id="year2024" checked>
                                <label class="form-check-label" for="year2024">2024</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="invoiceNo">Invoice No:</label>
                            <input type="text" id="invoiceNo" class="form-control txt-1">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="ticketInvoice">Ticket/Invoice:</label>
                            <select id="ticketInvoice" class="form-control txt-1">
                                <option value="all">All</option>
                                <option value="withInvoice">With Invoice</option>
                                <option value="withoutInvoice">Without Invoice</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="paxName">Pax Name:</label>
                            <input type="text" id="paxName" class="form-control txt-1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="source">Source:</label>
                            <select id="source" class="form-control txt-1">
                                <option value="">----------</option>
                                @foreach ($sources as $source)
                                    <option value="{{ trim($source->CODE) }}">{{ $source->DESCRIPTION }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="clientRef">Client Ref:</label>
                            <input type="text" id="clientRef" class="form-control txt-1">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="reloc">Reloc:</label>
                            <input type="text" id="reloc" class="form-control txt-1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="dateColumn">Date Column:</label>
                            <select id="dateColumn" class="form-control txt-1">
                                <option value="IssueDate">Issue Date</option>
                                <option value="InvoiceDate">Invoice Date</option>
                                <option value="DateRequested">Date Requested</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="dateFrom">Date From:</label>
                            <input type="text" id="dateFrom" class="form-control date-filter txt-1" data-date-format="yyyy-mm-dd" autocomplete="off">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="dateTo">Date To:</label>
                            <input type="text" id="dateTo" class="form-control date-filter txt-1" data-date-format="yyyy-mm-dd">
                        </div>
                    </div>
                    <button class="btn btn-primary" id="applyFilters">Apply Filters</button>
                    <button class="btn btn-secondary" id="clearFilters">Clear Form</button>
                </div>
            </div>

            <!-- Table -->
            <div class="row">
                <div id="tableDiv" class="table-responsive scroll p-2">
                    <span class="txt-1">(Hold SHIFT + Mouse Wheel UP or Down to scroll table horizontally)</span>
                    <table id="inventoryTable" class="table table-striped table-bordered">
                        <thead class="marsman-bg-color-dark text-white">
                            <tr>
                                <th>Issue Date</th>
                                <th>Ticket Number</th>
                                <th>Client Ref</th>
                                <th>Reloc</th>
                                <th>Invoice No</th>
                                <th>Ticket Status</th>
                                <th>Pax Name</th>
                                <th>Base Fare</th>
                                <th>Total Taxes</th>
                                <th>Total Fare</th>
                                <th>Source</th>
                                <th>Agent Sine</th>
                                <th>Invoice Date</th>
                                <th>Date Requested</th>
                                <th>Total Airfare</th>
                                <th>EMD Descr</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Data will be loaded dynamically using DataTables server-side processing --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
    /* Add your custom styles here */

    th, td {
        white-space: nowrap;
    }
    .excel-button {
        background-color: #4CAF50;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-bottom: 10px;
    }

    .excel-button:hover {
        background-color: #45a049;
    }

    .scroll {
        overflow: scroll;
        scrollbar-color: blue yellow;
        scrollbar-width: thick;
        visibility: visible;
    }

    #tableDiv td {
        font-size: small;
    }

</style>

<script>
    $(document).ready(function() {

        // Initialize Bootstrap Switch
        $('#parametersToggleSwitch').bootstrapSwitch();

        // Handle the switch state change
        $('#parametersToggleSwitch').on('switchChange.bootstrapSwitch', function(event, state) {
            if (state) {
                $('#parametersCardBody').slideDown(); // Show the card-body
            } else {
                $('#parametersCardBody').slideUp(); // Hide the card-body
            }
        });

        $('#tableDiv').doubleScroll({
            scrollCss: {
                'overflow-x': 'auto',
                'overflow-y': 'hidden',
                'scrollbar-color': 'blue yellow',
                'scrollbar-width': 'thick'
            },
            contentCss: {
                'overflow-x': 'auto',
                'overflow-y': 'hidden'
            },
        });

        // Initialize DataTable with server-side processing
        var table = $('#inventoryTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('inventory.fetchData') }}",
                "type": "POST",
                "data": function (d) {
                    // Additional data to be sent to the server
                    d._token = "{{ csrf_token() }}";
                    d.year2023 = $('#year2023').prop('checked');
                    d.year2024 = $('#year2024').prop('checked');
                    d.invoiceNo = $('#invoiceNo').val();
                    d.paxName = $('#paxName').val();
                    d.source = $('#source').val();
                    d.clientRef = $('#clientRef').val();
                    d.reloc = $('#reloc').val();
                    d.ticketInvoice = $('#ticketInvoice').val();
                    d.dateColumn = $('#dateColumn').val();
                    d.dateFrom = $('#dateFrom').val();
                    d.dateTo = $('#dateTo').val();
                    d.start = d.start || 0; // DataTables passes 'start' for pagination
                    d.length = 30; // Set the number of records per page to 30
                },
                "dataSrc": function (json) {
                    return json.data || []; // Return empty array if no data
                }
            },
            "columns": [
                { "data": "IssueDate" },
                { "data": "TicketNumber" },
                { "data": "ClientRef" },
                { "data": "Reloc" },
                { "data": "InvoiceNo" },
                { "data": "TicketStatus" },
                { "data": "PaxName" },
                { "data": "BaseFare" },
                { "data": "TotalTaxes" },
                { "data": "TotalFare" },
                { "data": "Source" },
                { "data": "AgentSine" },
                { "data": "InvoiceDate" },
                { "data": "DateRequested" },
                { "data": "TotalAirfare" },
                { "data": "EMDDescr" },
            ],
            "dom": 'Bfrtip',
            "buttons": [
                {
                    extend: 'excel',
                    className: 'excel-button',
                    text: 'Export to Excel',
                }
            ],
            "pageLength": 30,
            "deferRender": true, // Defer rendering of the table
        });

        // Enable Bootstrap tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Add date pickers for the selected date column
        $('.date-filter').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
        });

        // Function to load data when the "Apply Filters" button is clicked
        function loadData() {
            // Reload the DataTable to fetch and display data based on filters
            table.ajax.reload();
        }

        // Event listener for the "Apply Filters" button
        $('#applyFilters').on('click', function () {
            // Reset the DataTable to the first page when filters are applied
            table.page(0).draw('page');
            loadData(); // Call the function to load data
        });

        // Add onSelect event to copy selected date from 'Issue Date From' to 'Issue Date To'
        $('#dateFrom').on('change', function (selected) {
            if (selected && selected.date) {  // Check if selected and selected.date are defined
                var startDate = new Date(selected.date.valueOf());
                $('#dateTo').datepicker('setStartDate', startDate);
                // Copy the selected date to 'Date To'
                $('#dateTo').val($('#dateFrom').val());
            }
            $('#dateTo').val($('#dateFrom').val());
        });

        // Add input event to reflect typed input from 'Date From' to 'Date To'
        $('#dateFrom').on('input', function () {
            // Copy the typed input to 'Date To'
            $('#dateTo').val($(this).val());
        });

        // Clear form and redraw DataTable
        $('#clearFilters').on('click', function () {
            // Clear all form fields
            $('#invoiceNo, #paxName, #source, #clientRef, #reloc, #dateFrom, #dateTo').val('');
            // Reset date pickers
            $('.date-filter').datepicker('setDate', null);
            // Reset 'Ticket/Invoice' dropdown to 'All'
            $('#ticketInvoice').val('all');
            // Check 'All' radio button and uncheck others
            $('#allYears').prop('checked', true);
            $('#year2023').prop('checked', false);
            $('#year2024').prop('checked');

            // Clear DataTable data and redraw
            table.clear().draw();
        });
    });
</script>

@endsection
