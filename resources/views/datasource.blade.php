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
                <div class="card-header">
                    <h5 class="card-title">Parameters</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="year">Year:</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="year" id="allYears" checked>
                                <label class="form-check-label" for="allYears">All</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="year" id="year2023">
                                <label class="form-check-label" for="year2023">2023</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="year" id="year2024">
                                <label class="form-check-label" for="year2024">2024</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                        <div class="col-md-3 mb-3">
                            <label for="source">Source:</label>
                            <select id="source" class="form-control txt-1">
                                <option value="">----------</option>
                                @foreach ($sources as $source)
                                    <option value="{{ $source->CODE }}">{{ $source->DESCRIPTION }}</option>
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
                    </div>
                    <button class="btn btn-primary" id="applyFilters">Apply Filters</button>
                    <button class="btn btn-secondary" id="clearFilters">Clear Form</button>
                </div>
            </div>

            <!-- Table -->
            <div class="row">
                <div id="tableDiv" class="table-responsive scroll p-2">
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
                            {{-- Loop through your Inventory records here --}}
                            @foreach ($inventoryData2024 as $inventory)
                                <tr data-toggle="tooltip" data-placement="auto" title="{{ $inventory->Itinerary }}">
                                    <td>{{ $inventory->IssueDate }}</td>
                                    <td>{{ $inventory->TicketNumber }}</td>
                                    <td>{{ $inventory->ClientRef }}</td>
                                    <td>{{ $inventory->Reloc }}</td>
                                    <td>{{ $inventory->InvoiceNo }}</td>
                                    <td>{{ $inventory->TicketStatus }}</td>
                                    <td>{{ $inventory->PaxName }}</td>
                                    <td>&#8369;{{ number_format($inventory->BaseFare, 2) }}</td>
                                    <td>&#8369;{{ number_format($inventory->TotalTaxes, 2) }}</td>
                                    <td>&#8369;{{ number_format($inventory->TotalFare, 2) }}</td>
                                    <td>{{ $inventory->Source }}</td>
                                    <td>{{ $inventory->AgentSine }}</td>
                                    <td>{{ $inventory->InvoiceDate }}</td>
                                    <td>{{ $inventory->DateRequested }}</td>
                                    <td>&#8369;{{ number_format($inventory->TotalAirfare, 2) }}</td>
                                    <td>{{ $inventory->EMDDescr }}</td>
                                </tr>
                            @endforeach
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

        // Initialize DataTable
        var table = $('#inventoryTable').DataTable({
            "dom": 'Bfrtip',
            "buttons": [
                {
                    extend: 'excel',
                    className: 'excel-button',
                    text: 'Export to Excel',
                }
            ],
            "pageLength": 30,
        });

        // Hide DataTable pagination and length menu using jQuery and CSS
        $('.dataTables_length').css('display', 'none');

        // Enable Bootstrap tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Add date pickers for the selected date column
        $('.date-filter').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
        });

        // Apply dynamic search when filters are applied
        $('#applyFilters').on('click', function () {
            applyFilters();
        });

        // Add onSelect event to copy selected date from 'Issue Date From' to 'Issue Date To'
        $('#dateFrom').on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $('#dateTo').datepicker('setStartDate', startDate);
            // Copy the selected date to 'Date To'
            $('#dateTo').val($('#dateFrom').val());
        });

        // Add input event to reflect typed input from 'Date From' to 'Date To'
        $('#dateFrom').on('input', function () {
            // Copy the typed input to 'Date To'
            $('#dateTo').val($(this).val());
        });

        // Add click event for the 'Clear Form' button
        $('#clearFilters').on('click', function () {
            // Clear all form fields
            $('#invoiceNo, #paxName, #source, #clientRef, #reloc, #dateFrom, #dateTo').val('');
            // Reset date pickers
            $('.date-filter').datepicker('setDate', null);
            // Reset 'Ticket/Invoice' dropdown to 'All'
            $('#ticketInvoice').val('all');
            // Check 'All' radio button and uncheck others
            $('#allYears').prop('checked', true);
            $('#year2023, #year2024').prop('checked', false);

            // Apply dynamic search with empty filters to reset the DataTable
            applyFilters();
        });

        // Function to apply dynamic search filters
        function applyFilters() {
            var dateColumn = $('#dateColumn').val();
            var dateFrom = $('#dateFrom').val();
            var dateTo = $('#dateTo').val();
            var invoiceNo = $('#invoiceNo').val().toLowerCase();
            var paxName = $('#paxName').val().toLowerCase();
            var source = $('#source').val().toLowerCase();
            var clientRef = $('#clientRef').val().toLowerCase();
            var reloc = $('#reloc').val().toLowerCase();
            var ticketInvoice = $('#ticketInvoice').val();
            var allYears = $('#allYears').prop('checked');
            var year2023 = $('#year2023').prop('checked');
            var year2024 = $('#year2024').prop('checked');

            $.fn.dataTable.ext.search.pop(); // Remove existing search functions

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var issueDate = data[0];
                    var invoiceDate = data[11]; // Index of "Invoice Date" column
                    var dateRequested = data[12]; // Index of "Date Requested" column
                    var selectedDate = (dateColumn === 'IssueDate') ? issueDate :
                                        (dateColumn === 'InvoiceDate') ? invoiceDate : dateRequested;

                    var dateInRange = (dateFrom === '' || (selectedDate >= dateFrom && selectedDate <= dateTo));
                    var invoiceNoMatch = (invoiceNo === '' || data[10].toLowerCase().includes(invoiceNo));
                    var paxNameMatch = (paxName === '' || data[4].toLowerCase().includes(paxName));
                    var sourceMatch = (source === '' || data[8].toLowerCase().includes(source));
                    var clientRefMatch = (clientRef === '' || data[12].toLowerCase().includes(clientRef));
                    var relocMatch = (reloc === '' || data[2].toLowerCase().includes(reloc));
                    var yearMatch = allYears || (year2023 && data[0].includes('2023')) || (year2024 && data[0].includes('2024'));

                    // Apply 'Ticket/Invoice' filter
                    if (ticketInvoice === 'withInvoice') {
                        return dateInRange && !invoiceNoMatch && paxNameMatch && sourceMatch && clientRefMatch && relocMatch && yearMatch;
                    } else if (ticketInvoice === 'withoutInvoice') {
                        return dateInRange && invoiceNoMatch && paxNameMatch && sourceMatch && clientRefMatch && relocMatch && yearMatch;
                    } else {
                        return dateInRange && invoiceNoMatch && paxNameMatch && sourceMatch && clientRefMatch && relocMatch && yearMatch;
                    }
                }
            );

            // Redraw the DataTable with new filters
            table.draw();
        }
    });
</script>

@endsection
