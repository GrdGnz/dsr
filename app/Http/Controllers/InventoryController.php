<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Source;

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

        return view('datasource', compact('inventoryData2024', 'sources'));
    }

}
