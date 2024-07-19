<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Source;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sources = Source::all();

        // Initialize arrays to hold the counts and sums for each source
        $totalIssuedCounts = [];
        $totalInvoiceCounts = [];
        $totalFareSumsPHP = [];
        $totalFareSumsUSD = [];

        foreach ($sources as $source) {
            $totalIssuedCounts[$source->CODE] = Inventory::where('Source', $source->CODE)
                ->whereNotNull('IssueDate')
                ->count();

            $totalInvoiceCounts[$source->CODE] = Inventory::where('Source', $source->CODE)
                ->whereNotNull('InvoiceNo')
                ->count();

            $totalFareSumsPHP[$source->CODE] = Inventory::where('Source', $source->CODE)
                ->where('Currency', 'PHP')
                ->sum('TotalFare');

            $totalFareSumsUSD[$source->CODE] = Inventory::where('Source', $source->CODE)
                ->where('Currency', 'USD')
                ->sum('TotalFare');
        }

        return view('home', compact('sources', 'totalIssuedCounts', 'totalInvoiceCounts', 'totalFareSumsPHP', 'totalFareSumsUSD'));
    }

}
