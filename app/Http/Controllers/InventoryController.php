<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventoryData = Inventory::all();

        $inventoryData->transform(function ($item) {
            $item->PaxName = strtoupper($item->PaxName);
            return $item;
        });

        return view('datasource', compact('inventoryData'));
    }

}
