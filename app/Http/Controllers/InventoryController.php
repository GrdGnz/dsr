<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Source;
use Yajra\DataTables\DataTables;

class InventoryController extends Controller
{
    public function index()
    {
        // Fetch inventory data with IssueDate having year 2024
        $inventoryData2024 = Inventory::all();
        $sources = Source::all();

        $inventoryData2024->transform(function ($item) {
            $item->PaxName = strtoupper($item->PaxName);
            return $item;
        });

        return view('datasource', compact('sources'));
    }

    public function fetchData(Request $request)
    {
        $query = Inventory::query();

        // Apply filters based on request parameters
        if ($request->has('year2023') && $request->boolean('year2023')) {
            $query->whereYear('IssueDate', 2023);
        }

        if ($request->has('year2024') && $request->boolean('year2024')) {
            $query->whereYear('IssueDate', 2024);
        }

        if ($request->filled('invoiceNo')) {
            $query->where('InvoiceNo', 'like', '%' . $request->input('invoiceNo') . '%');
        }

        if ($request->filled('clientRefInv')) {
            $query->where('ClientRefInv', 'like', '%' . $request->input('clientRefInv') . '%');
        }

        if ($request->filled('ticketInvoice')) {
            if ($request->input('ticketInvoice') === 'withInvoice') {
                $query->whereNotNull('InvoiceNo');
            } elseif ($request->input('ticketInvoice') === 'withoutInvoice') {
                $query->whereNull('InvoiceNo');
            }
        }

        if ($request->filled('paxName')) {
            $query->where('PaxName', 'like', '%' . $request->input('paxName') . '%');
        }

        if ($request->filled('source')) {
            $query->where('Source', $request->input('source'));
        }

        if ($request->filled('clientRef')) {
            $query->where('ClientRef', 'like', '%' . $request->input('clientRef') . '%');
        }

        if ($request->filled('reloc')) {
            $query->where('Reloc', 'like', '%' . $request->input('reloc') . '%');
        }

        if ($request->filled('dateColumn') && $request->filled('dateFrom') && $request->filled('dateTo')) {
            $dateColumn = $request->input('dateColumn');
            $dateFrom = $request->input('dateFrom');
            $dateTo = $request->input('dateTo');

            $query->whereBetween($dateColumn, [$dateFrom, $dateTo]);
        }

        // Return data for DataTables
        return DataTables::of($query)
            ->addColumn('formatted_base_fare', function ($inventory) {
                return '&#8369;' . number_format($inventory->BaseFare, 2);
            })
            ->addColumn('formatted_total_taxes', function ($inventory) {
                return '&#8369;' . number_format($inventory->TotalTaxes, 2);
            })
            ->addColumn('formatted_total_fare', function ($inventory) {
                return '&#8369;' . number_format($inventory->TotalFare, 2);
            })
            ->addColumn('formatted_total_airfare', function ($inventory) {
                return '&#8369;' . number_format($inventory->TotalAirfare, 2);
            })
            ->addColumn('formatted_invoice_date', function ($inventory) {
                return $inventory->InvoiceDate ? date('Y-m-d', strtotime($inventory->InvoiceDate)) : '';
            })
            ->addColumn('formatted_date_requested', function ($inventory) {
                return $inventory->DateRequested ? date('Y-m-d', strtotime($inventory->DateRequested)) : '';
            })
            ->rawColumns(['formatted_base_fare', 'formatted_total_taxes', 'formatted_total_fare', 'formatted_total_airfare', 'formatted_invoice_date', 'formatted_date_requested'])
            ->make(true);
    }

}
