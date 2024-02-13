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
                    <div class="row mt-5">
                        <div class="col-md-3 mb-3">
                            <label for="issueDateFrom">Issue Date From:</label>
                            <input type="text" id="issueDateFrom" class="form-control date-filter" data-date-format="yyyy-mm-dd" autocomplete="off">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="issueDateTo">Issue Date To:</label>
                            <input type="text" id="issueDateTo" class="form-control date-filter" data-date-format="yyyy-mm-dd">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="invoiceNo">Invoice No:</label>
                            <input type="text" id="invoiceNo" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="paxName">Pax Name:</label>
                            <input type="text" id="paxName" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="source">Source:</label>
                            <select id="source" class="form-control">
                                <option value="">----------</option>
                                @foreach ($sources as $source)
                                    <option value="{{ $source->CODE }}">{{ $source->DESCRIPTION }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="clientRef">Client Ref:</label>
                            <input type="text" id="clientRef" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="reloc">Reloc:</label>
                            <input type="text" id="reloc" class="form-control">
                        </div>
                    </div>
                    <button class="btn btn-primary" id="applyFilters">Apply Filters</button>
                </div>
            </div>

            <!-- Table -->
            <div class="row">
                <div id="tableDiv" class="table-responsive scroll p-2">
                    <table id="inventoryTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Issue Date</th>
                                <th>Ticket Number</th>
                                <th>Reloc</th>
                                <th>Ticket Status</th>
                                <th>Pax Name</th>
                                <th>Base Fare</th>
                                <th>Total Taxes</th>
                                <th>Total Fare</th>
                                <th>Source</th>
                                <th>Agent Sine</th>
                                <th>Invoice No</th>
                                <th>EMD Descr</th>
                                <th>Date Upload</th>
                                <th>Client Ref</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through your Inventory records here --}}
                            @foreach ($inventoryData as $inventory)
                                <tr data-toggle="tooltip" data-placement="auto" title="{{ $inventory->Itinerary }}">
                                    <td>{{ $inventory->IssueDate }}</td>
                                    <td>{{ $inventory->TicketNumber }}</td>
                                    <td>{{ $inventory->Reloc }}</td>
                                    <td>{{ $inventory->TicketStatus }}</td>
                                    <td>{{ $inventory->PaxName }}</td>
                                    <td>&#8369;{{ number_format($inventory->BaseFare, 2) }}</td>
                                    <td>&#8369;{{ number_format($inventory->TotalTaxes, 2) }}</td>
                                    <td>&#8369;{{ number_format($inventory->TotalFare, 2) }}</td>
                                    <td>{{ $inventory->Source }}</td>
                                    <td>{{ $inventory->AgentSine }}</td>
                                    <td>{{ $inventory->InvoiceNo }}</td>
                                    <td>{{ $inventory->EMDDescr }}</td>
                                    <td>{{ $inventory->DateUpload }}</td>
                                    <td>{{ $inventory->ClientRef }}</td>
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

        // Add date pickers for "Issue Date" columns
        $('.date-filter').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
        });

        // Add onSelect event to copy selected date from 'Issue Date From' to 'Issue Date To'
        $('#issueDateFrom').on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $('#issueDateTo').datepicker('setStartDate', startDate);
            // Copy the selected date to 'Issue Date To'
            $('#issueDateTo').val($('#issueDateFrom').val());
        });

        // Add input event to reflect typed input from 'Issue Date From' to 'Issue Date To'
        $('#issueDateFrom').on('input', function () {
            // Copy the typed input to 'Issue Date To'
            $('#issueDateTo').val($(this).val());
        });

        // Apply dynamic search when filters are applied
        $('#applyFilters').on('click', function () {
            applyFilters();
        });

        // Function to apply dynamic search filters
        function applyFilters() {
            var issueDateFrom = $('#issueDateFrom').val();
            var issueDateTo = $('#issueDateTo').val();
            var invoiceNo = $('#invoiceNo').val().toLowerCase();
            var paxName = $('#paxName').val().toLowerCase();
            var source = $('#source').val().toLowerCase();
            var clientRef = $('#clientRef').val().toLowerCase();
            var reloc = $('#reloc').val().toLowerCase(); // Add this line for the 'Reloc' filter

            $.fn.dataTable.ext.search.pop(); // Remove existing search functions

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var issueDate = data[0];
                    var invoiceNoData = data[10].toLowerCase();
                    var paxNameData = data[4].toLowerCase();
                    var sourceData = data[8].toLowerCase();
                    var clientRefData = data[12].toLowerCase();
                    var relocData = data[2].toLowerCase(); // Index of "Reloc" column

                    var issueDateInRange = (issueDateFrom === '' || (issueDate >= issueDateFrom && issueDate <= issueDateTo));
                    var invoiceNoMatch = (invoiceNo === '' || invoiceNoData.includes(invoiceNo));
                    var paxNameMatch = (paxName === '' || paxNameData.includes(paxName));
                    var sourceMatch = (source === '' || sourceData.includes(source));
                    var clientRefMatch = (clientRef === '' || clientRefData.includes(clientRef));
                    var relocMatch = (reloc === '' || relocData.includes(reloc)); // Add this line for the 'Reloc' filter

                    // Check if 'Source' is not blank, then apply the filter
                    var sourceMatch = (source === '' || sourceData.includes(source));

                    return issueDateInRange && invoiceNoMatch && paxNameMatch && sourceMatch && clientRefMatch && relocMatch; // Add 'relocMatch' here
                }
            );

            // Redraw the DataTable with new filters
            table.draw();
        }
    });
</script>

@endsection
