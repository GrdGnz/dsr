<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'DSRInventory';

    protected $fillable = [
        'TicketNumber',
        'TicketStatus',
        'IssueDate',
        'Reloc',
        'BookingClass',
        'AirlineCode',
        'ClientRef',
        'PaxName',
        'ItineraryType',
        'Itinerary',
        'Currency',
        'BaseFare',
        'TotalTaxes',
        'TotalFare',
        'Source',
        'AgentSine',
        'EMDDescr',
        'InvoiceNo',
        'DateReqeusted',
        'TotalAirfare',
        'Remarks',
        'DateUpload',
        'UploadBy',
    ];

    public function source()
    {
        return $this->belongsTo(Source::class, 'Source', 'CODE');
    }

}
